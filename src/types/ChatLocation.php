<?php

namespace leealex\telegram\types;

/**
 * Represents a location to which a chat is connected.
 *
 * @see https://core.telegram.org/bots/api#chatlocation
 * @package leealex\telegram\types
 *
 * @property Location $location The location to which the supergroup is connected. Can't be a live location.
 *
 * @property string $address Location address; 1-64 characters, as defined by the chat owner
 */
class ChatLocation extends BaseType
{
}
