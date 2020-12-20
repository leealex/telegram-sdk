<?php

namespace TgSdk;

/**
 * Class Telegram
 */
class Telegram
{
    /**
     * @var Api
     */
    private $api;

    /**
     */
    public function __construct()
    {
        $this->api = new Api();
    }

    public function dispatch()
    {
        return true;
    }
}
