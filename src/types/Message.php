<?php

namespace leealex\telegram\types;

/**
 * This object represents a message.
 *
 * @see https://core.telegram.org/bots/api#message
 * @package leealex\telegram\types
 */
class Message extends BaseType
{
    /**
     * Unique message identifier inside this chat
     * @var integer
     */
    public $message_id;
    /**
     * Optional. Sender, empty for messages sent to channels
     * @var User
     */
    public $from;
    /**
     * Optional. Sender of the message, sent on behalf of a chat. The channel itself for channel messages.
     * The supergroup itself for messages from anonymous group administrators. The linked channel for messages
     * automatically forwarded to the discussion group
     * @var Chat
     */
    public $sender_chat;
    /**
     * Date the message was sent in Unix time
     * @var integer
     */
    public $date;
    /**
     * Conversation the message belongs to
     * @var Chat
     */
    public $chat;
    /**
     * Optional. For forwarded messages, sender of the original message
     * @var User
     */
    public $forward_from;
    /**
     * Optional. For messages forwarded from channels or from anonymous administrators,
     * information about the original sender chat
     * @var Chat
     */
    public $forward_from_chat;
    /**
     * Optional. For messages forwarded from channels, identifier of the original message in the channel
     * @var integer
     */
    public $forward_from_message_id;
    /**
     * Optional. For messages forwarded from channels, signature of the post author if present
     * @var string
     */
    public $forward_signature;
    /**
     * Optional. Sender's name for messages forwarded from users who disallow adding a link to their account in forwarded messages
     * @var string
     */
    public $forward_sender_name;
    /**
     * Optional. For forwarded messages, date the original message was sent in Unix time
     * @var integer
     */
    public $forward_date;
    /**
     * Optional. For replies, the original message. Note that the Message object in this field will not contain further
     * reply_to_message fields even if it itself is a reply.
     * @var Message
     */
    public $reply_to_message;
    /**
     * Optional. Bot through which the message was sent
     * @var User
     */
    public $via_bot;
    /**
     * Optional. Date the message was last edited in Unix time
     * @var integer
     */
    public $edit_date;
    /**
     * Optional. The unique identifier of a media message group this message belongs to
     * @var string
     */
    public $media_group_id;
    /**
     * Optional. Signature of the post author for messages in channels, or the custom title of an anonymous group administrator
     * @var string
     */
    public $author_signature;
    /**
     * Optional. For text messages, the actual UTF-8 text of the message, 0-4096 characters
     * @var string
     */
    public $text;
    /**
     * Optional. For text messages, special entities like usernames, URLs, bot commands, etc. that appear in the text
     * @var MessageEntity[]
     */
    public $entities;
    /**
     * Optional. Message is an animation, information about the animation. For backward compatibility, when this field
     * is set, the document field will also be set
     * @var
     */
    public $animation;
    public $audio;
    public $document;
    public $photo;
    public $sticker;
    public $video;
    public $video_note;
    public $voice;
    /**
     * Optional. Caption for the animation, audio, document, photo, video or voice, 0-1024 characters
     * @var string
     */
    public $caption;
    /**
     * Optional. For messages with a caption, special entities like usernames, URLs, bot commands, etc.
     * that appear in the caption
     * @var MessageEntity[]
     */
    public $caption_entities;
    public $contact;
    public $dice;
    public $game;
    public $poll;
    public $venue;
    /**
     * Optional. Message is a shared location, information about the location
     * @var Location
     */
    public $location;
    /**
     * Optional. New members that were added to the group or supergroup and information about them (the bot itself
     * may be one of these members)
     * @var User[]
     */
    public $new_chat_members;
    /**
     * Optional. A member was removed from the group, information about them (this member may be the bot itself)
     * @var User
     */
    public $left_chat_member;
    /**
     * Optional. A chat title was changed to this value
     * @var string
     */
    public $new_chat_title;
    public $new_chat_photo;
    /**
     * Optional. Service message: the chat photo was deleted
     * @var true
     */
    public $delete_chat_photo;
    /**
     * Optional. Service message: the group has been created
     * @var true
     */
    public $group_chat_created;
    /**
     * Optional. Service message: the supergroup has been created. This field can't be received in a message coming
     * through updates, because bot can't be a member of a supergroup when it is created. It can only be found in
     * reply_to_message if someone replies to a very first message in a directly created supergroup.
     * @var true
     */
    public $supergroup_chat_created;
    /**
     * Optional. Service message: the channel has been created. This field can't be received in a message coming
     * through updates, because bot can't be a member of a channel when it is created. It can only be found in
     * reply_to_message if someone replies to a very first message in a channel.
     * @var true
     */
    public $channel_chat_created;
    /**
     * Optional. The group has been migrated to a supergroup with the specified identifier. This number may be greater
     * than 32 bits and some programming languages may have difficulty/silent defects in interpreting it. But it is
     * smaller than 52 bits, so a signed 64 bit integer or double-precision float type are safe for storing this identifier.
     * @var integer
     */
    public $migrate_to_chat_id;
    /**
     * Optional. The supergroup has been migrated from a group with the specified identifier. This number may be greater
     * than 32 bits and some programming languages may have difficulty/silent defects in interpreting it. But it is
     * smaller than 52 bits, so a signed 64 bit integer or double-precision float type are safe for storing this identifier.
     * @var integer
     */
    public $migrate_from_chat_id;
    /**
     * Optional. Specified message was pinned. Note that the Message object in this field will not contain further
     * reply_to_message fields even if it is itself a reply.
     * @var Message
     */
    public $pinned_message;
    public $invoice;
    public $successful_payment;
    /**
     * Optional. The domain name of the website on which the user has logged in. More about Telegram Login
     * @see https://core.telegram.org/widgets/login
     * @var string
     */
    public $connected_website;
    public $passport_data;
    public $proximity_alert_triggered;
    /**
     * Optional. Inline keyboard attached to the message. login_url buttons are represented as ordinary url buttons.
     * @var InlineKeyboardMarkup
     */
    public $reply_markup;
}
