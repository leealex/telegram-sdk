<?php

namespace TgSdk\objects;

/**
 * Class Update
 * @see https://core.telegram.org/bots/api#update
 * @package TgSdk
 */
class Update extends BaseObject
{
    public $update_id;
    public $message;
    public $edited_message;
    public $channel_post;
    public $edited_channel_post;
    public $inline_query;
    public $chosen_inline_result;
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
     * @var Entity
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
