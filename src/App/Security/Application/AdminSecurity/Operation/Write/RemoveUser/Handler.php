<?php

declare(strict_types=1);

namespace App\Security\Application\AdminSecurity\Operation\Write\RemoveUser;

use App\Security\Application\AdminSecurity\Operation\Write\RecoverPassword\PasswordRecoveryWasRemoved;
use Mono\Component\AdminSecurity\Domain\Repository\FindUserById;
use Mono\Component\AdminSecurity\Domain\Repository\RemoveUser;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\DispatchAfterCurrentBusStamp;
use Symfony\Component\Security\Core\User\UserInterface;

final class Handler implements MessageHandlerInterface
{
    public function __construct(
        private FindUserById $reader,
        private RemoveUser $writer,
        private MessageBusInterface $eventBus,
    ) {
    }

    public function __invoke(Command $command): UserInterface
    {
        $user = $this->reader->find($command->getId());

        $this->writer->remove($user);
        $this->eventBus->dispatch(
            (new Envelope(new PasswordRecoveryWasRemoved($user->getId()->getValue())))
                ->with(new DispatchAfterCurrentBusStamp())
        );

        return $user;
    }
}
