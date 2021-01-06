<?php

namespace TelegramSDK\types;

/**
 * Class Message
 * @see https://core.telegram.org/bots/api#message
 * @package TelegramSDK
 */
class Message extends BaseType
{
    /**
     * @var integer
     */
    public $message_id;
    /**
     * @var User
     */
    public $from;
    /**
     * @var Chat
     */
    public $chat;
    /**
     * @var integer
     */
    public $date;
    /**
     * @var string
     */
    public $text;
    /**
     * @var array
     */
    public $entities;
}
