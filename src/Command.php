<?php

namespace leealex\telegram;

use leealex\telegram\types\Update;

/**
 * Class Command
 * @package leealex\telegram
 */
abstract class Command
{
    /**
     * @var Bot
     */
    protected $bot;
    /**
     * @var string Command Name
     */
    protected $name;

    /**
     * @var string Command Description
     */
    protected $description;

    /**
     * Run command
     * @param mixed ...$args
     * @return mixed
     */
    abstract function execute(...$args);

    /**
     * Command constructor.
     * @param Bot $bot
     */
    public function __construct(Bot $bot)
    {
        $this->bot = $bot;
    }

    /**
     * @return Update
     */
    public function getUpdate(): Update
    {
        return $this->bot->update;
    }
}
