<?php

namespace leealex\telegram\types;

/**
 * This object represents one button of the reply keyboard. For simple text buttons String can be used
 * instead of this object to specify text of the button. Optional fields request_contact, request_location,
 * and request_poll are mutually exclusive.
 *
 * @see https://core.telegram.org/bots/api#keyboardbutton
 * @package leealex\telegram\types
 */
class KeyboardButton extends BaseType
{
    /**
     * Text of the button. If none of the optional fields are used, it will be sent as a message when the button is pressed
     * @var string
     */
    public $text;
    /**
     * Optional. If True, the user's phone number will be sent as a contact when the button is pressed.
     * Available in private chats only
     * @var boolean
     */
    public $request_contact;
    /**
     * Optional. If True, the user's current location will be sent when the button is pressed.
     * Available in private chats only
     * @var boolean
     */
    public $request_location;
    /**
     * Optional. If specified, the user will be asked to create a poll and send it to the bot when the button is pressed.
     * Available in private chats only
     * @var
     */
    public $request_poll;
}