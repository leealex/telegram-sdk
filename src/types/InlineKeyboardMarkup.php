<?php

namespace leealex\telegram\types;

/**
 * This object represents an inline keyboard that appears right next to the message it belongs to.
 *
 * @see https://core.telegram.org/bots/api#inlinekeyboardmarkup
 * @package leealex\telegram\types
 */
class InlineKeyboardMarkup extends BaseType
{
    /**
     * Array of button rows, each represented by an Array of InlineKeyboardButton objects
     * @var InlineKeyboardButton[]
     */
    public $inline_keyboard;
}