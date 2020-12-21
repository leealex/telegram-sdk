<?php

namespace TgSdk\commands;

use TgSdk\Action;
use TgSdk\Api;
use TgSdk\Command;

/**
 * Class DefaultCommand
 * @package TgSdk\commands
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