<?php

namespace leealex\telegram\types;

/**
 * This object represents a chat.
 *
 * @see https://core.telegram.org/bots/api#chat
 * @package leealex\telegram\types
 *
 * @property integer $id Unique identifier for this chat. This number may be greater than 32 bits and some programming
 * languages may have difficulty/silent defects in interpreting it. But it is smaller than 52 bits,
 * so a signed 64 bit integer or double-precision float type are safe for storing this identifier.
 *
 * @property string $type Type of chat, can be either “private”, “group”, “supergroup” or “channel”
 *
 * @property string $title Optional. Title, for supergroups, channels and group chats
 *
 * @property string $username Optional. Username, for private chats, supergroups and channels if available
 *
 * @property string $first_name Optional. First name of the other party in a private chat
 *
 * @property string $last_name Optional. Last name of the other party in a private chat
 *
 * @property ChatPhoto $photo Optional. Chat photo. Returned only in getChat.
 *
 * @property string $bio Optional. Bio of the other party in a private chat. Returned only in getChat.
 *
 * @property string $description Optional. Description, for groups, supergroups and channel chats. Returned only in getChat.
 *
 * @property string $invite_link Optional. Chat invite link, for groups, supergroups and channel chats.
 * Each administrator in a chat generates their own invite links, so the bot must first generate the link
 * using exportChatInviteLink. Returned only in getChat.
 *
 * @property Message $pinned_message Optional. The most recent pinned message (by sending date). Returned only in getChat.
 *
 * @property ChatPermissions $permissions Optional. Default chat member permissions, for groups and supergroups.
 * Returned only in getChat.
 *
 * @property integer $slow_mode_delay Optional. For supergroups, the minimum allowed delay between consecutive
 * messages sent by each unpriviledged user. Returned only in getChat.
 *
 * @property string $sticker_set_name Optional. For supergroups, name of group sticker set. Returned only in getChat.
 *
 * @property boolean $can_set_sticker_set Optional. True, if the bot can change the group sticker set. Returned only in getChat.
 *
 * @property integer $linked_chat_id Optional. Unique identifier for the linked chat, i.e. the discussion group
 * identifier for a channel and vice versa; for supergroups and channel chats. This identifier may be greater
 * than 32 bits and some programming languages may have difficulty/silent defects in interpreting it.
 * But it is smaller than 52 bits, so a signed 64 bit integer or double-precision float type are safe for storing
 * this identifier. Returned only in getChat.
 *
 * @property ChatLocation $location Optional. For supergroups, the location to which the supergroup is connected.
 * Returned only in getChat.
 */
class Chat extends BaseType
{
}
