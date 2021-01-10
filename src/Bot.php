<?php

namespace leealex\telegram;

use GuzzleHttp\Client;
use SleekDB\SleekDB;
use leealex\telegram\commands\DefaultCommand;
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
     * @var array
     */
    public $commandsMap = [];
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
        if (!$this->token = $token) {
            throw new \Exception('Telegram bot token required.');
        }
        $this->client = new Client();
        $this->setDb(sys_get_temp_dir());
        $this->commands[] = DefaultCommand::class;
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
     * Defining commands
     * @param array $commands
     */
    public function setCommands(array $commands)
    {
        $commands = array_merge($this->commands, $commands);
        $this->commands = [];
        foreach ($commands as $command) {
            if (class_exists($command)) {
                $className = substr(strrchr($command, '\\'), 1);
                $commandName = strtolower(str_replace('Command', '', $className));
                $this->commands[$commandName] = $command;
            }
        }
    }

    /**
     * @param array $map
     */
    public function setCommandsMap(array $map)
    {
        $this->commandsMap = $map;
    }

    /**
     * Handling incoming update
     * @param bool $debug
     * @return bool|\Exception|\Throwable
     */
    public function run($debug = false)
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
                if ($result[0]['update_id'] < $updateId) {
                    $this->db->where('_id', '=', 1)->update(['update_id' => $updateId]);
                    if ($debug && $this->adminId) {
                        $this->chatId = '117780107';
                        $this->sendMessage('<pre>' . json_encode($data) . '</pre>');
                    }
                    $this->chatId = $this->update->user->id;
                    $this->runCommand();
                }
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
        if ($text = str_replace('/', '', $this->update->text)) {
            if (isset($this->commandsMap[$text])) {
                $text = $this->commandsMap[$text];
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
