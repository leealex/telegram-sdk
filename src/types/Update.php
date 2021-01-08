<?php

namespace leealex\telegram\types;

/**
 * This object represents an incoming update.
 * At most one of the optional parameters can be present in any given update.
 *
 * @see https://core.telegram.org/bots/api#update
 * @package leealex\telegram\types
 */
class Update extends BaseType
{
    /**
     * The update's unique identifier. Update identifiers start from a certain positive number and increase sequentially.
     * This ID becomes especially handy if you're using Webhooks, since it allows you to ignore repeated updates or to
     * restore the correct update sequence, should they get out of order. If there are no new updates for at least a week,
     * then identifier of the next update will be chosen randomly instead of sequentially.
     * @var integer
     */
    public $update_id;
    /**
     * Optional. New incoming message of any kind — text, photo, sticker, etc.
     * @var Message
     */
    public $message;
    /**
     * Optional. New version of a message that is known to the bot and was edited
     * @var Message
     */
    public $edited_message;
    /**
     * Optional. New incoming channel post of any kind — text, photo, sticker, etc.
     * @var Message
     */
    public $channel_post;
    /**
     * Optional. New version of a channel post that is known to the bot and was edited
     * @var Message
     */
    public $edited_channel_post;
    /**
     * Optional. New incoming inline query
     * @var InlineQuery
     */
    public $inline_query;
    public $chosen_inline_result;
    /**
     * Optional. New incoming callback query
     * @var CallbackQuery
     */
    public $callback_query;
    public $shipping_query;
    public $pre_checkout_query;
    public $poll;
    public $poll_answer;

    /**
     * @var User
     */
    public $user;
    /**
     * @var string
     */
    public $text;

    /**
     * {@inheritDoc}
     */
    public function __construct(array $data)
    {
        parent::__construct($data);

        if ($this->message) {
            $this->user = $this->message->from;
            $this->text = $this->message->text;
        }
        if ($this->callback_query) {
            $this->user = $this->callback_query->from;
            $this->text = $this->callback_query->data;
        }
        if ($this->shipping_query) {
            $this->user = $this->shipping_query->from;
        }
        if ($this->pre_checkout_query) {
            $this->user = $this->pre_checkout_query->from;
        }
        if ($this->poll_answer) {
            $this->user = $this->poll_answer->user;
        }
    }
}
