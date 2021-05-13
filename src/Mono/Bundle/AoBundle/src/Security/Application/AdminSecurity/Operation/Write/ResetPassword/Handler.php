<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Security\Application\AdminSecurity\Operation\Write\ResetPassword;

use Mono\Bundle\AoBundle\Security\Domain\Entity\AdminPasswordRecovery;
use Mono\Component\AdminSecurity\Domain\Entity\PasswordRecoveryInterface;
use Mono\Component\AdminSecurity\Domain\Repository\CreatePasswordRecovery;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Messenger\MessageBusInterface;

final class Handler implements MessageHandlerInterface
{
    public function __construct(
        private CreatePasswordRecovery $repository,
        private MessageBusInterface $eventBus,
    ) {
    }

    public function __invoke(Command $command): PasswordRecoveryInterface
    {
        $entity = AdminPasswordRecovery::create(
            $this->repository->nextIdentity(),
            $command->getUser()
        );

        $this->repository->insert($entity);
        $this->eventBus->dispatch(new AdminPasswordWasReset($entity));

        return $entity;
    }
}
