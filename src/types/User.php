<?php

namespace leealex\telegram\types;

/**
 * This object represents a Telegram user or bot.
 *
 * @see https://core.telegram.org/bots/api#user
 * @package leealex\telegram\types
 */
class User extends BaseType
{
    /**
     * Unique identifier for this user or bot
     * @var integer
     */
    public $id;
    /**
     * True, if this user is a bot
     * @var boolean
     */
    public $is_bot;
    /**
     * User's or bot's first name
     * @var string
     */
    public $first_name;
    /**
     * Optional. User's or bot's last name
     * @var string
     */
    public $last_name;
    /**
     * Optional. User's or bot's username
     * @var string
     */
    public $username;
    /**
     * Optional. IETF language tag of the user's language
     * @var string
     */
    public $language_code;
    /**
     * Optional. True, if the bot can be invited to groups. Returned only in getMe.
     * @var boolean
     */
    public $can_join_groups;
    /**
     * Optional. True, if privacy mode is disabled for the bot. Returned only in getMe.
     * @var boolean
     */
    public $can_read_all_group_messages;
    /**
     * Optional. True, if the bot supports inline queries. Returned only in getMe.
     * @var boolean
     */
    public $supports_inline_queries;
}
