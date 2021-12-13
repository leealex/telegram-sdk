<?php

namespace leealex\telegram\types;

/**
 * This object represents a poll answer.
 *
 * @see https://core.telegram.org/bots/api#pollanswer
 * @package leealex\telegram\types
 *
 * @property string $poll_id Unique poll identifier
 *
 * @property User $user The user, who changed the answer to the poll
 *
 * @property integer[] $option_ids 0-based identifiers of answer options, chosen by the user. May be empty if the user
 * retracted their vote.
 */
class PollAnswer extends BaseType
{
}
