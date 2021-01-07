<?php

namespace leealex\telegram\types;

/**
 * Class ChatPhoto
 * @see https://core.telegram.org/bots/api#chatphoto
 * @package leealex\telegram\types
 */
class ChatPhoto extends BaseType
{
    /**
     * @var string
     */
    public $small_file_id;
    /**
     * @var string
     */
    public $small_file_unique_id;
    /**
     * @var string
     */
    public $big_file_id;
    /**
     * @var string
     */
    public $big_file_unique_id;
}
