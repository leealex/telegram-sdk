<?php

namespace TgSdk\objects;

/**
 * Class Update
 * @see https://core.telegram.org/bots/api#update
 * @package TgSdk
 */
class CallbackQuery extends BaseObject
{
    public $id;
    public $from;
    public $message;
    public $inline_message_id;
    public $chat_instance;
    public $data;
    public $game_short_name;
}