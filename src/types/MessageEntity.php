<?php

namespace TelegramSDK\types;

/**
 * Class Entity
 * @see https://core.telegram.org/bots/api#messageentity
 * @package TelegramSDK
 */
class MessageEntity extends BaseType
{
    const TYPE_MENTION = 'mention';
    const TYPE_HASHTAG = 'hashtag';
    const TYPE_CASHTAG = 'cashtag';
    const TYPE_BOT_COMMAND = 'bot_command';
    const TYPE_URL = 'url';
    const TYPE_EMAIL = 'email';
    const TYPE_PHONE_number = 'phone_number';
    const TYPE_BOLD = 'bold';
    const TYPE_ITALIC = 'italic';
    const TYPE_UNDERLINE = 'underline';
    const TYPE_STRIKETHROUGH = 'strikethrough';
    const TYPE_CODE = 'code';
    const TYPE_PRE = 'pre';
    const TYPE_TEXT_LINK = 'text_link';
    const TYPE_TEXT_MENTION = 'text_mention';

    public $type;
    public $offset;
    public $length;
    public $url;
    public $user;
    public $language;
}