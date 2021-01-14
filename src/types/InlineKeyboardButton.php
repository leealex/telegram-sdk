<?php

namespace leealex\telegram\types;

/**
 * InlineKeyboardMarkup
 * This object represents an inline keyboard that appears right next to the message it belongs to.
 *
 * @see https://core.telegram.org/bots/api#inlinekeyboardmarkup
 * @package leealex\telegram\types
 *
 * @property string $text Label text on the button
 *
 * @property string $url Optional. HTTP or tg:// url to be opened when button is pressed
 *
 * @property LoginUrl $login_url Optional. An HTTP URL used to automatically authorize the user.
 * Can be used as a replacement for the Telegram Login Widget.
 *
 * @property string $callback_data Optional. Data to be sent in a callback query to the bot when button is pressed, 1-64 bytes
 *
 * @property string $switch_inline_query Optional. If set, pressing the button will prompt the user to select
 * one of their chats, open that chat and insert the bot's username and the specified inline query in the input field.
 * Can be empty, in which case just the bot's username will be inserted.
 * Note: This offers an easy way for users to start using your bot in inline mode when they are currently in a
 * private chat with it. Especially useful when combined with switch_pm… actions – in this case the user will be
 * automatically returned to the chat they switched from, skipping the chat selection screen.
 *
 * @property string $switch_inline_query_current_chat Optional. If set, pressing the button will insert
 * the bot's username and the specified inline query in the current chat's input field. Can be empty, in which case only
 * the bot's username will be inserted.
 *
 * @property CallbackGame $callback_game Optional. Description of the game that will be launched when the user presses the button.
 *
 * @property boolean $pay Optional. Specify True, to send a Pay button.
 * NOTE: This type of button must always be the first button in the first row.
 */
class InlineKeyboardButton extends BaseType
{
}