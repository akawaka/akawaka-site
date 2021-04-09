<?php

declare(strict_types=1);

namespace Mono\Component\AdminSecurity\Application\Operation\Write\Authenticate;

use Mono\Component\AdminSecurity\Domain\Repository\Update;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Security\Core\User\UserInterface;

final class Handler implements MessageHandlerInterface
{
    public function __construct(
        private Update $repository,
        private MessageBusInterface $eventBus,
    ) {
    }

    public function __invoke(Command $command): UserInterface
    {
        $user = $command->getUser();
        $user->connect();

        $this->repository->update($user);
        $this->eventBus->dispatch(new AdminWasAuthenticated($user));

        return $user;
    }
}
