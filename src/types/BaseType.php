<?php

namespace leealex\telegram\types;

/**
 * Base type class, all types must extend this class
 * @package leealex\telegram\types
 */
class BaseType
{
    /**
     * Available types
     * @see https://core.telegram.org/bots/api#available-types
     * @var string[]
     */
    const TYPES = [
        'message' => 'Message',
        'edited_message' => 'Message',
        'channel_post' => 'Message',
        'edited_channel_post' => 'Message',
        'inline_query' => 'InlineQuery',
        'chosen_inline_result' => 'ChosenInlineResult',
        'callback_query' => 'CallbackQuery',
        'shipping_query' => 'ShippingQuery',
        'pre_checkout_query' => 'PreCheckoutQuery',
        'poll' => 'Poll',
        'poll_answer' => 'PollAnswer',
        'from' => 'User',
        'sender_chat' => 'Chat',
        'chat' => 'Chat',
        'forward_from' => 'User',
        'forward_from_chat' => 'Chat',
        'reply_to_message' => 'Message',
        'via_bot' => 'User',
        'animation' => 'Animation',
        'audio' => 'Audio',
        'document' => 'Document',
        'sticker' => 'Sticker',
        'video' => 'Video',
        'video_note' => 'VideoNote',
        'voice' => 'Voice',
        'contact' => 'Contact',
        'dice' => 'Dice',
        'game' => 'Game',
        'venue' => 'Venue',
        'location' => 'Location',
        'left_chat_member' => 'User',
        'pinned_message' => 'Message',
        'invoice' => 'Invoice',
        'successful_payment' => 'SuccessfulPayment',
        'passport_data' => 'PassportData',
        'proximity_alert_triggered' => 'ProximityAlertTriggered',
        'reply_markup' => 'InlineKeyboardMarkup',
    ];

    /**
     * BaseObject constructor.
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        if ($data) {
            foreach ($data as $field => $value) {
                $this->{$field} = $this->getObject($field, $value);
            }
        }
        $this->validate();
    }

    /**
     * @param $name
     * @return null
     */
    public function __get($name)
    {
        return null;
    }

    /**
     * This method will be called at the end of the constructor.
     */
    public function validate()
    {
    }

    /**
     * Creating object by it's name and populate it with data or return fields
     * @param string $type Object type
     * @param string|array $fields
     * @return string|array|BaseType
     * @throws \Exception
     */
    public function getObject(string $type, $fields)
    {
        if (isset(self::TYPES[$type])) {
            $class = 'leealex\telegram\types\\' . self::TYPES[$type];
            if (class_exists($class)) {
                return new $class($fields);
            }
        }
        return $fields;
    }
}