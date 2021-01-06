<?php

namespace TelegramSDK\types;

/**
 * Class Chat
 * @see https://core.telegram.org/bots/api#chat
 * @package TelegramSDK
 */
class Chat extends BaseType
{
    public $id;
    public $type;
    public $title;
    public $username;
    public $first_name;
    public $last_name;
    public $photo;
    public $bio;
    public $description;
    public $invite_link;
    public $pinned_message;
    public $permissions;
    public $slow_mode_delay;
    public $sticker_set_name;
    public $can_set_sticker_set;
    public $linked_chat_id;
    public $location;
}
