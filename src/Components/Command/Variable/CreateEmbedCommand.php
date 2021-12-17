<?php

namespace Gerfey\GrandoEspadaDiscord\Components\Command\Variable;

use Discord\Discord;
use Discord\Parts\Channel\Message;
use Discord\Parts\Embed\Embed;
use Exception;
use Gerfey\GrandoEspadaDiscord\Components\Command\CommandInterface;

class CreateEmbedCommand implements CommandInterface
{
    /**
     * @throws Exception
     */
    public function handle(Message $message, Discord $discord): void
    {
        $channel = $message->channel;

        $text = str_replace(['!embed'], '', $message->content);

        $embed = new Embed($discord);
        $embed->setDescription($text);

        $channel->sendEmbed($embed);
    }
}