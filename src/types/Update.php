<?php

namespace leealex\telegram\types;

/**
 * Class Update
 * @see https://core.telegram.org/bots/api#update
 * @package leealex\telegram\types
 */
class Update extends BaseType
{
    /**
     * @var integer
     */
    public $update_id;
    /**
     * @var Message
     */
    public $message;
    /**
     * @var Message
     */
    public $edited_message;
    /**
     * @var Message
     */
    public $channel_post;
    /**
     * @var Message
     */
    public $edited_channel_post;
    /**
     * @var InlineQuery
     */
    public $inline_query;
    /**
     * @var
     */
    public $chosen_inline_result;
    /**
     * @var CallbackQuery
     */
    public $callback_query;
    /**
     * @var
     */
    public $shipping_query;
    /**
     * @var
     */
    public $pre_checkout_query;
    /**
     * @var
     */
    public $poll;
    /**
     * @var
     */
    public $poll_answer;
    /**
     * @var User
     */
    public $user;
    /**
     * @var MessageEntity
     */
    public $entity;
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
