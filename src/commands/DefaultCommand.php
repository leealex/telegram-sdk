<?php

namespace TelegramSDK\commands;

use TelegramSDK\Command;

/**
 * Class DefaultCommand
 * @package TelegramSDK\commands
 */
class DefaultCommand extends Command
{
    /**
     * @var string Command Name
     */
    protected $name = "default";

    /**
     * @var string Command Description
     */
    protected $description = "Default command";

    /**
     * @inheritDoc
     */
    public function run(...$args)
    {
        $this->api->sendMessage('Hi, this is default command.');
    }
}