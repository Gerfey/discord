<?php

namespace Gerfey\GrandoEspadaDiscord\Components\Command;

class ParserCommand
{
    private string $symbol = '!';

    private ?string $command = null;

    private string $message;

    public function setMessage(string $message): void
    {
        $this->message = $message;
    }

    public function handle(): bool
    {
        if ($this->symbol === mb_substr($this->message, 0, 1)) {
            $explodeString = explode(' ', $this->message);
            $this->command = str_replace($this->symbol, '', $explodeString[0]);
            return true;
        }

        return false;
    }

    public function getTypeCommand(): ?string
    {
        return $this->command;
    }
}