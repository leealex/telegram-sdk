<?php

namespace TelegramSDK;

use GuzzleHttp\Client;
use SleekDB\SleekDB;
use TelegramSDK\commands\DefaultCommand;
use TelegramSDK\objects\Update;

/**
 * Class Telegram
 */
class Telegram extends Api
{
    /**
     * @var Update
     */
    protected $update;
    /**
     * @var Command[]
     */
    protected $commands = [];
    /**
     * @var array
     */
    protected $commandsMap = [];
    /**
     * @var integer Admin's ID for debugging purposes
     */
    protected $adminId;

    /**
     * Telegram constructor.
     * @param string $token
     * @param array $config
     * [
     * db_dir => ''
     * admin_id => ''
     * ]
     * @throws \Exception
     */
    public function __construct(string $token, array $config = [])
    {
        if (!$this->token = $token) {
            throw new \Exception('Telegram bot token required.');
        }
        $this->client = new Client();

        $dbDir = $config['db_dir'] ?? sys_get_temp_dir();
        $this->adminId = $config['admin_id'] ?? null;
        $this->db = SleekDB::store('bot', $dbDir);

        $this->commands[] = DefaultCommand::class;
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
     * @throws \Exception
     */
    public function dispatch($debug = false)
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
        call_user_func_array([$command, 'run'], $arguments);
    }
}
