<?php

declare(strict_types=1);

namespace App\Security\Application\AdminSecurity\Operation\Write\AuthenticateUser;

use Mono\Component\AdminSecurity\Domain\Entity\UserInterface;
use Mono\Component\AdminSecurity\Domain\Repository\FindUserById;
use Mono\Component\AdminSecurity\Domain\Repository\UpdateUser;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\DispatchAfterCurrentBusStamp;

final class Handler implements MessageHandlerInterface
{
    public function __construct(
        private FindUserById $reader,
        private UpdateUser $writer,
        private MessageBusInterface $eventBus,
    ) {
    }

    public function __invoke(Command $command): UserInterface
    {
        $user = $this->reader->find($command->getId());
        $user->connect();

        $this->writer->update($user);
        $this->eventBus->dispatch(
            (new Envelope(new AdminWasAuthenticated($user->getId()->getValue())))
                ->with(new DispatchAfterCurrentBusStamp())
        );

        return $user;
    }
}
