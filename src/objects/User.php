<?php

namespace TelegramSDK\objects;

/**
 * Class Update
 * @see https://core.telegram.org/bots/api#update
 * @package TelegramSDK
 */
class User extends BaseObject
{
    public $id;
    public $is_bot;
    public $first_name;
    public $last_name;
    public $username;
    public $language_code;
    public $can_join_groups;
    public $can_read_all_group_messages;
    public $supports_inline_queries;
}
