<?php

namespace leealex\telegram\types;

/**
 * This object represents changes in the status of a chat member.
 *
 * @see https://core.telegram.org/bots/api#chatmemberupdated
 * @package leealex\telegram\types
 *
 * @property Chat $chat Chat the user belongs to
 *
 * @property User $from Performer of the action, which resulted in the change
 *
 * @property integer $date Date the change was done in Unix time
 *
 * @property ChatMember $old_chat_member Previous information about the chat member
 *
 * @property ChatMember $new_chat_member New information about the chat member
 *
 * @property ChatInviteLink $invite_link Optional. Chat invite link, which was used by the user to join the chat;
 * for joining by invite link events only.
 *
 * @property boolean $via_join_request Optional. True, if the user joined the chat after sending a direct join request
 * without using an invite link and being approved by an administrator
 *
 * @property boolean $via_chat_folder_invite_link Optional. True, if the user joined the chat via a chat folder invite link
 */
class ChatMemberUpdated extends BaseType
{
}
