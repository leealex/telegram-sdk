<?php

namespace leealex\telegram\commands;

use leealex\telegram\Command;

/**
 * Class DefaultCommand
 * @package leealex\telegram\commands
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