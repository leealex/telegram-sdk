<?php

namespace TgSdk;

use GuzzleHttp\Client;
use SleekDB\SleekDB;
use TgSdk\commands\DefaultCommand;
use TgSdk\objects\Update;

/**
 * Class Telegram
 */
class Telegram extends Api
{
    /**
     * @var string|null
     */
    private $dbDir;
    /**
     * @var Update
     */
    private $update;
    /**
     * @var Command[]
     */
    protected $commands = [];

    /**
     * Telegram constructor.
     * @param string $token
     * @param array $config
     * [
     * db_dir => '/'
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
        $this->db = new SleekDB($dbDir);
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
     * Handling incoming update
     * @throws \Exception
     */
    public function dispatch()
    {
        $data = json_decode(file_get_contents('php://input'), true);

        if ($this->update = new Update($data)) {
            $this->chatId = $this->update->user->id;
            $this->runCommand();
        }
    }

    /**
     * Running command by it's name
     */
    private function runCommand()
    {
        $commandName = 'default';
        if ($text = str_replace('/', '', $this->update->text)) {
            if ($arguments = explode(' ', $text)) {
                $name = array_shift($arguments);
                if (isset($this->commands[$name])){
                    $commandName = $name;
                }
            }
        }
        /** @var Command $command */
        $command = new $this->commands[$commandName]($this);
        call_user_func_array([$command, 'run'], $arguments);
    }
}
