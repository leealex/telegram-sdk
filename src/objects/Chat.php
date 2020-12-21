<?php

namespace TgSdk\objects;

/**
 * Class Update
 * @see https://core.telegram.org/bots/api#update
 * @package TgSdk
 */
class Chat extends BaseObject
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
