<?php

namespace TelegramSDK\objects;

/**
 * Class Update
 * @see https://core.telegram.org/bots/api#update
 * @package TelegramSDK
 */
class Message extends BaseObject
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
