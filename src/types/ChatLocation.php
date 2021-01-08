<?php

namespace leealex\telegram\types;

/**
 * Represents a location to which a chat is connected.
 *
 * @see https://core.telegram.org/bots/api#chatlocation
 * @package leealex\telegram\types
 */
class ChatLocation extends BaseType
{
    /**
     * The location to which the supergroup is connected. Can't be a live location.
     * @var Location
     */
    public $location;
    /**
     * Location address; 1-64 characters, as defined by the chat owner
     * @var string
     */
    public $address;
}
