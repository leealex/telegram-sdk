<?php

namespace leealex\telegram\types;

/**
 * Class Chat
 * @see https://core.telegram.org/bots/api#chat
 * @package leealex\telegram\types
 */
class Chat extends BaseType
{
    /**
     * @var integer
     */
    public $id;
    /**
     * @var string
     */
    public $type;
    /**
     * @var string
     */
    public $title;
    /**
     * @var string
     */
    public $username;
    /**
     * @var string
     */
    public $first_name;
    /**
     * @var string
     */
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
