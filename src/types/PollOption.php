<?php

namespace leealex\telegram\types;

/**
 * This object represents a poll option.
 *
 * @see https://core.telegram.org/bots/api#polloption
 * @package leealex\telegram\types
 *
 * @property string $text Option text, 1-100 characters
 *
 * @property integer $voter_count Number of users that voted for this option
 */
class PollOption extends BaseType
{
}
