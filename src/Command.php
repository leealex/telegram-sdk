<?php

namespace leealex\telegram;

use leealex\telegram\types\InlineKeyboardMarkup;
use leealex\telegram\types\ReplyKeyboardMarkup;
use leealex\telegram\types\Update;

/**
 * Class Command
 * @package leealex\telegram
 */
abstract class Command
{
    /**
     * @var Bot
     */
    protected $bot;
    /**
     * @var string Command Name
     */
    protected $name;

    /**
     * @var string Command Description
     */
    protected $description;

    /**
     * Run command
     * @param mixed ...$args
     * @return mixed
     */
    abstract function execute(...$args);

    /**
     * Command constructor.
     * @param Bot $bot
     */
    public function __construct(Bot $bot)
    {
        $this->bot = $bot;
    }

    /**
     * @return Update
     */
    public function getUpdate(): Update
    {
        return $this->bot->update;
    }

    /**
     * Reply keyboard
     * @param array $buttons Array of rows, each row contains buttons as array or string
     * @param array $options @see ReplyKeyboardMarkup
     * @return false|string JSON-encoded reply keyboard object
     */
    public function keyboard(array $buttons, array $options = [])
    {
        $keyboard = new ReplyKeyboardMarkup([
            'keyboard' => $buttons
        ]);
        foreach ($options as $name => $value) {
            $keyboard->{$name} = $value;
        }
        return json_encode($keyboard);
    }

    /**
     * Inline keyboard
     * @param array $buttons Array of rows, each row contains buttons as array or string
     * @param array $options @see InlineKeyboardMarkup
     * @return false|string JSON-encoded reply keyboard object
     */
    public function inlineKeyboard(array $buttons, array $options = [])
    {
        $keyboard = new InlineKeyboardMarkup([
            'inline_keyboard' => $buttons
        ]);
        foreach ($options as $name => $value) {
            $keyboard->{$name} = $value;
        }
        return json_encode($keyboard);
    }
}
