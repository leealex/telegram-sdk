<?php

namespace leealex\telegram\commands;

use leealex\telegram\Command;

/**
 * Class DefaultCommand
 * @package leealex\telegram\commands
 */
class DefaultCommand extends Command
{
    /**
     * @var string Command Name
     */
    protected $name = "default";

    /**
     * @var string Command Description
     */
    protected $description = "Default command";

    /**
     * @inheritDoc
     */
    public function execute(...$args)
    {
        $update = $this->getUpdate();
        $keyboard = $this->createKeyboard([
            [['text' => '', 'command' => ''], ['text' => '', 'command' => '']],
            [],
            []
        ]);


        $buttons = [
            ['🍲 Супы', '🍛 Второе'],
            ['🥨 Выпечка', '🥗 Салаты'],
            ['🍧 Десерты', '🥪 Закуски']
        ];
        $keyboard = json_encode([
            'keyboard' => $buttons,
            'resize_keyboard' => true
        ]);

        $this->bot->sendMessage('Выбери тип блюда', 'html', true, $keyboard);
    }
}