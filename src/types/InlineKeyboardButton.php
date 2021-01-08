<?php

namespace leealex\telegram\types;

/**
 * This object represents one button of an inline keyboard. You must use exactly one of the optional fields.
 *
 * @see https://core.telegram.org/bots/api#inlinekeyboardbutton
 * @package leealex\telegram\types
 */
class InlineKeyboardButton extends BaseType
{
    /**
     * Label text on the button
     * @var string
     */
    public $text;
    /**
     * Optional. HTTP or tg:// url to be opened when button is pressed
     * @var string
     */
    public $url;
    /**
     * Optional. An HTTP URL used to automatically authorize the user. Can be used as a replacement for the Telegram Login Widget.
     * @var LoginUrl
     */
    public $login_url;
    /**
     * Optional. Data to be sent in a callback query to the bot when button is pressed, 1-64 bytes
     * @var string
     */
    public $callback_data;
    /**
     * Optional. If set, pressing the button will prompt the user to select one of their chats, open that chat and
     * insert the bot's username and the specified inline query in the input field. Can be empty, in which case just
     * the bot's username will be inserted.
     *
     * Note: This offers an easy way for users to start using your bot in inline mode when they are currently in a
     * private chat with it. Especially useful when combined with switch_pm… actions – in this case the user will be
     * automatically returned to the chat they switched from, skipping the chat selection screen.
     * @var string
     */
    public $switch_inline_query;
    /**
     * Optional. If set, pressing the button will insert the bot's username and the specified inline query in the
     * current chat's input field. Can be empty, in which case only the bot's username will be inserted.
     * @var string
     */
    public $switch_inline_query_current_chat;
    public $callback_game;
    /**
     * Optional. Specify True, to send a Pay button.
     *
     * NOTE: This type of button must always be the first button in the first row.
     * @var boolean
     */
    public $pay;
}