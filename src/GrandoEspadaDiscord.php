<?php

namespace Gerfey\GrandoEspadaDiscord;

use Discord\Discord;
use Discord\Parts\Channel\Message;
use Gerfey\GrandoEspadaDiscord\Components\Command\CommandSubscriber;
use Gerfey\GrandoEspadaDiscord\Components\Command\ParserCommand;

class GrandoEspadaDiscord
{
    private Message $message;

    private Discord $discord;

    private CommandSubscriber $commandSubscriber;

    private ParserCommand $parserCommand;

    public function __construct(CommandSubscriber $commandSubscriber, ParserCommand $parserCommand)
    {
        $this->commandSubscriber = $commandSubscriber;
        $this->parserCommand = $parserCommand;
    }

    public function handle()
    {
        $this->parserCommand->setMessage($this->message->content);

        if (!$this->message->author->bot) {
            if ($this->parserCommand->handle()) {
                $command = $this->commandSubscriber->getCommand($this->parserCommand->getTypeCommand());

                if (null !== $command) {
                    $command->handle($this->message, $this->discord);
                }
            }
        }
    }

    public function setMessage(Message $message): void
    {
        $this->message = $message;
    }

    public function setDiscord(Discord $discord): void
    {
        $this->discord = $discord;
    }

}