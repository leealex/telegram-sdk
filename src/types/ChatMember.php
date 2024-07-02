<?php

namespace leealex\telegram\types;

/**
 * This object contains information about one member of a chat
 *
 * @see https://core.telegram.org/bots/api#chatmember
 * @package leealex\telegram\types
 *
 * @property User $user Information about the user
 *
 * @property string $status The member's status in the chat
 *
 * @property string $is_anonymous True, if the user's presence in the chat is hidden
 *
 * @property string $custom_title Optional. Custom title for this user
 *
 * @property integer $until_date Date when restrictions will be lifted for this user; Unix time. If 0, then the user is banned forever
 */
class ChatMember extends BaseType
{
}
