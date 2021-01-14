<?php

namespace leealex\telegram;

use GuzzleHttp\Client;
use SleekDB\SleekDB;
use leealex\telegram\types\Update;

/**
 * Class Bot
 * @package leealex\telegram
 */
class Bot extends Api
{
    /**
     * @var Update
     */
    public $update;
    /**
     * @var Command[]
     */
    public $commands = [];
    /**
     * Aliases are primarily used for reply keyboards, which, unlike inline keyboards, cannot pass callback queries.
     * Reply keyboard passes the text of the button itself, which may contain emoji.
     * You can use aliases to convert the text on a button to a command. Example:
     * [
     *     'Button 1️⃣ 🙂' => 'SomeCommand argument1 argument2',
     *     'Button 2️⃣ 👍' => 'AnotherCommand argument1',
     * ]
     * @var array
     */
    public $commandsAliases = [];
    /**
     * @var integer[] Admin IDs
     */
    public $admins = [];

    /**
     * Telegram constructor.
     * @param string $token
     * @throws \Exception
     */
    public function __construct(string $token)
    {
        $a = get_defined_functions();
        if (!$this->token = $token) {
            throw new \Exception('Telegram bot token required.');
        }
        $this->client = new Client();
        $this->setDb(sys_get_temp_dir());
        $this->loadCommands(__DIR__ . '/commands');
    }

    /**
     * Initiates a database with the specified path
     * @param string $path
     * @throws \Exception
     */
    public function setDb(string $path)
    {
        $this->db = SleekDB::store('bot', $path);
    }

    /**
     * Defines admins with their IDs
     * @param array $ids
     */
    public function setAdmins(array $ids)
    {
        $this->admins = $ids;
    }

    /**
     * Loads user's commands by specified url
     * @param string $path
     * @throws \ReflectionException
     */
    public function setCommandsPath(string $path)
    {
        $this->loadCommands($path);
    }

    /**
     * Loads commands by specified path
     * @param string $path
     * @throws \ReflectionException
     */
    protected function loadCommands(string $path)
    {
        $commands = array_filter(scandir($path), function ($item) use ($path) {
            return !is_dir($path . '/' . $item);
        });
        foreach ($commands as $command) {
            $namespace = $this->getNamespace($path . '/' . $command);
            $class = $namespace . '\\' . substr($command, 0, -4);
            if (class_exists($class)) {
                $reflectionClass = new \ReflectionClass($class);
                $parent = $reflectionClass->getParentClass();
                if ($parent->getName() === 'leealex\telegram\Command') {
                    $className = substr(strrchr($class, '\\'), 1);
                    $commandName = strtolower(str_replace('Command', '', $className));
                    $this->commands[$commandName] = $class;
                }
            }
        }
    }

    /**
     * Get class's namespace by it's path
     * @param string $path
     * @return mixed|null
     */
    protected function getNamespace(string $path)
    {
        $data = file_get_contents($path);
        if (preg_match('/^namespace\s+(.+?);/m', $data, $matches)) {
            return $matches[1];
        }
        return null;
    }

    /**
     * @param array $aliases
     */
    public function setCommandsAliases(array $aliases)
    {
        $this->commandsAliases = $aliases;
    }

    /**
     * Handling incoming update
     * @param bool $debug Send raw update to admin
     * @param bool $onlyNew Skip old updates
     * @return bool|\Exception|\Throwable
     */
    public function run($debug = false, $onlyNew = true)
    {
        $data = json_decode(file_get_contents('php://input'), true);

        try {
            if ($this->update = new Update($data)) {
                $updateId = $this->update->update_id;
                if (!$result = $this->db->where('_id', '=', 1)->fetch()) {
                    $this->db->insert(['update_id' => 0]);
                    $result[0]['update_id'] = 0;
                }
                // Run command if the update is new
                if ($onlyNew && $result[0]['update_id'] >= $updateId) {
                    return true;
                }
                $this->db->where('_id', '=', 1)->update(['update_id' => $updateId]);
                if ($debug && $this->admins) {
                    foreach ($this->admins as $id) {
                        $this->chatId = $id;
                        $this->sendMessage('<pre>' . json_encode($data) . '</pre>');
                    }
                }
                $this->chatId = $this->update->user->id;
                $this->runCommand();
            }
            return true;
        } catch (\Throwable $e) {
            return $e;
        }
    }

    /**
     * Running command by it's name
     */
    private function runCommand()
    {
        $commandName = 'default';
        $arguments = [];
        if ($text = str_replace('/', '', $this->update->text)) {
            if (isset($this->commandsMap[$text])) {
                $text = $this->commandsAliases[$text];
            }
            if ($arguments = explode(' ', $text)) {
                $name = strtolower(array_shift($arguments));
                if (isset($this->commands[$name])) {
                    $commandName = $name;
                }
            }
        }
        /** @var Command $command */
        $command = new $this->commands[$commandName]($this);
        call_user_func_array([$command, 'execute'], $arguments);
    }
}
