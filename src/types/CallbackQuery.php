<?php

namespace leealex\telegram\types;

/**
 * Class CallbackQuery
 * @see https://core.telegram.org/bots/api#callbackquery
 * @package leealex\telegram\types
 */
class CallbackQuery extends BaseType
{
    /**
     * @var string
     */
    public $id;
    /**
     * @var User
     */
    public $from;
    /**
     * @var Message
     */
    public $message;
    /**
     * @var string
     */
    public $inline_message_id;
    /**
     * @var string
     */
    public $chat_instance;
    /**
     * @var string
     */
    public $data;
    /**
     * @var string
     */
    public $game_short_name;
}
