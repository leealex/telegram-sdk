<?php

namespace leealex\telegram\commands;

use leealex\telegram\Command;

/**
 * Returns current User's object
 * @package app\modules\bot\commands
 */
class WhoisCommand extends Command
{
    /**
     * @var string Command Name
     */
    protected $name = 'whois';

    /**
     * @var string Command Description
     */
    protected $description = 'Returns current User\'s object';

    /**
     * @inheritdoc
     */
    public function execute(...$args)
    {
        $update = $this->getUpdate();
        $text = 'Could not get User\'s profile';
        if ($update->user) {
            $text = [
                'ID: <code>' . $update->user->id . '</code>',
                'First name: <code>' . $update->user->first_name . '</code>',
                'Last name: <code>' . $update->user->last_name . '</code>',
                'Username: <code>' . $update->user->username . '</code>',
                'Language code: <code>' . $update->user->language_code . '</code>'
            ];
        }
        $this->bot->sendMessage($text);
    }
}