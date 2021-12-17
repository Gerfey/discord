<?php

namespace Gerfey\GrandoEspadaDiscord\Components\Command\Variable;

use Discord\Discord;
use Discord\Parts\Channel\Message;
use Discord\Parts\Embed\Embed;
use Discord\Parts\Permissions\RolePermission;
use Discord\Parts\User\Member;
use Discord\Parts\User\User;
use Exception;
use Gerfey\GrandoEspadaDiscord\Components\Command\CommandInterface;

class TestCommand implements CommandInterface
{
    /**
     * @throws Exception
     */
    public function handle(Message $message, Discord $discord): void
    {
        if (!$message->member->getPermissions()->administrator) {
            $message->reply('У тебя нет прав на данное действие!');
        } else {
            $message->reply('Серега, а хде ДПС?');
        }

//        foreach ($discord->users->toArray() as $user) {
//            /**
//             * @var User $user
//             */
//            if ($user->username == 'Multiwave') {
//                dd($user);
//            }
//        }
    }
}