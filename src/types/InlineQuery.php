<?php

namespace leealex\telegram\types;

/**
 * Class InlineQuery
 * @see https://core.telegram.org/bots/api#inlinequery
 * @package leealex\telegram\types
 */
class InlineQuery extends BaseType
{
    public $id;
    public $from;
    public $message;
    public $inline_message_id;
    public $chat_instance;
    public $data;
    public $game_short_name;
}
