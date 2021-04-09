<?php

declare(strict_types=1);

namespace Mono\Component\AdminSecurity\Application\Operation\Write\Remove;

use Mono\Component\AdminSecurity\Domain\Repository\Remove;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Security\Core\User\UserInterface;

final class Handler implements MessageHandlerInterface
{
    public function __construct(
        private Remove $repository,
        private MessageBusInterface $eventBus,
    ) {
    }

    public function __invoke(Command $command): UserInterface
    {
        $user = $command->getUser();

        $this->repository->remove($user);
        $this->eventBus->dispatch(new AdminWasRemoved($user));

        return $user;
    }
}
