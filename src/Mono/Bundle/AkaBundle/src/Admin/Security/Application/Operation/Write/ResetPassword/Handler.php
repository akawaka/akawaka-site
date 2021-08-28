<?php

declare(strict_types=1);

namespace Mono\Bundle\AkaBundle\Admin\Security\Application\Operation\Write\ResetPassword;

use App\Security\Domain\Entity\AdminPasswordRecovery;
use Mono\Bundle\AkaBundle\Shared\Domain\Entity\PasswordRecoveryInterface;
use Mono\Bundle\AkaBundle\Shared\Domain\Repository\CreatePasswordRecovery;
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
