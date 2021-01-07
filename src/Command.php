<?php

namespace leealex\telegram;

/**
 * Class Command
 * @package leealex\telegram
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
     * @param Api $api
     */
    public function __construct(Api $api)
    {
        $this->api = $api;
    }
}
