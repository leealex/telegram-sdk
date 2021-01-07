<?php

namespace leealex\telegram\types;

/**
 * Class Message
 * @see https://core.telegram.org/bots/api#message
 * @package leealex\telegram\types
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
