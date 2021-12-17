<?php

namespace Gerfey\GrandoEspadaDiscord\Components\Command;

use Discord\Discord;
use Discord\Parts\Channel\Message;

interface CommandInterface
{
    public function handle(Message $message, Discord $discord): void;
}