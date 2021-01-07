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
    protected static $types = [
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
    public function __construct(array $data)
    {
        try {
            foreach ($data as $field => $value) {
                if (property_exists($this, $field)) {
                    $this->$field = is_array($value) ? $this->getObject($field, $value) : $value;
                }
            }
            return $this;
        } catch (\Throwable $e) {
            return false;
        }
    }

    /**
     * Creating object by it's name and populate it with data
     * @param string $type Object type
     * @param array $fields
     * @return false|mixed
     * @throws \Exception
     */
    public function getObject(string $type, array $fields)
    {
        if (isset(self::$types[$type])) {
            $class = 'TelegramSDK\types\\' . self::$types[$type];
            if (class_exists($class)) {
                return new $class($fields);
            }
        }
        return false;
    }
}