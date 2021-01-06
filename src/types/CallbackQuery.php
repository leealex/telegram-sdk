<?php

namespace TelegramSDK\types;

/**
 * Class CallbackQuery
 * @see https://core.telegram.org/bots/api#callbackquery
 * @package TelegramSDK
 */
class CallbackQuery extends BaseType
{
    public $id;
    public $from;
    public $message;
    public $inline_message_id;
    public $chat_instance;
    public $data;
    public $game_short_name;
}
