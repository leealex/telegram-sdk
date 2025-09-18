<?php

namespace leealex\telegram\types;

/**
 * This object represents an incoming update.
 * At most one of the optional parameters can be present in any given update.
 *
 * @see https://core.telegram.org/bots/api#update
 * @package leealex\telegram\types
 *
 * @property integer $update_id The update's unique identifier. Update identifiers start from a certain positive number
 * and increase sequentially. This ID becomes especially handy if you're using Webhooks, since it allows you to ignore
 * repeated updates or to restore the correct update sequence, should they get out of order. If there are no new updates
 * for at least a week, then identifier of the next update will be chosen randomly instead of sequentially.
 *
 * @property Message $message Optional. New incoming message of any kind — text, photo, sticker, etc.
 *
 * @property Message $edited_message Optional. New version of a message that is known to the bot and was edited
 *
 * @property Message $channel_post Optional. New incoming channel post of any kind — text, photo, sticker, etc.
 *
 * @property Message $edited_channel_post Optional. New version of a channel post that is known to the bot and was edited
 *
 * @property InlineQuery $inline_query Optional. New incoming inline query
 *
 * @property ChosenInlineResult $chosen_inline_result Optional. The result of an inline query that was chosen by a user
 * and sent to their chat partner. Please see our documentation on the feedback collecting for details on how to enable
 * these updates for your bot.
 *
 * @property CallbackQuery $callback_query Optional. New incoming callback query
 *
 * @property ShippingQuery $shipping_query Optional. New incoming shipping query. Only for invoices with flexible price
 *
 * @property PreCheckoutQuery $pre_checkout_query Optional. New incoming pre-checkout query. Contains full information
 * about checkout
 *
 * @property Poll $poll Optional. New poll state. Bots receive only updates about stopped polls and polls,
 * which are sent by the bot
 *
 * @property PollAnswer $poll_answer Optional. A user changed their answer in a non-anonymous poll.
 * Bots receive new votes only in polls that were sent by the bot itself.
 *
 * @property User $user Custom property that holds User object
 *
 * @property string $text Custom property that holds input text
 *
 * @property ChatMemberUpdated $chat_member Optional. A chat member's status was updated in a chat. The bot must be an administrator
 * in the chat and must explicitly specify "chat_member" in the list of allowed_updates to receive these updates.
 *
 * @property ChatMemberUpdated $my_chat_member Optional. The bot's chat member status was updated in a chat. For private chats,
 * this update is received only when the bot is blocked or unblocked by the user.
 */
class Update extends BaseType
{
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
