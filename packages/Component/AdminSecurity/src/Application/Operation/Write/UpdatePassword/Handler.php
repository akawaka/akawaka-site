<?php

declare(strict_types=1);

namespace Mono\Component\AdminSecurity\Application\Operation\Write\UpdatePassword;

use Mono\Component\AdminSecurity\Domain\Repository\Update;
use Mono\Component\Core\Infrastructure\MessageBus\EventBusInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\User\UserInterface;

final class Handler implements MessageHandlerInterface
{
    public function __construct(
        private Update $repository,
        private UserPasswordEncoderInterface $passwordEncoder,
        private EventBusInterface $eventBus,
    ) {
    }

    public function __invoke(Command $command): UserInterface
    {
        $entity = $command->getUser();

        $entity->updatePassword(
            $this->passwordEncoder->encodePassword($entity, $command->getPassword())
        );

        $this->repository->update($entity);
        ($this->eventBus)(new AdminPasswordWasUpdated($entity));

        return $entity;
    }
}
