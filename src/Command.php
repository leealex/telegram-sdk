<?php

namespace TgSdk;

use TgSdk\objects\Update;

/**
 * Class Update
 * @see https://core.telegram.org/bots/api#update
 * @package TgSdk
 */
abstract class Command
{
    /**
     * @var Api
     */
    protected $api;
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
    abstract function run(...$args);

    /**
     * Command constructor.
     */
    public function __construct(Api $api)
    {
        $this->api = $api;
    }
}
