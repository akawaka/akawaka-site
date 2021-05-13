<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Security\Application\AdminSecurity\Operation\Write\Register;

use Mono\Bundle\AoBundle\Security\Domain\Entity\AdminUser;
use Mono\Component\AdminSecurity\Domain\Repository\CreateUser;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\User\UserInterface;

final class Handler implements MessageHandlerInterface
{
    public function __construct(
        private CreateUser $repository,
        private UserPasswordEncoderInterface $passwordEncoder,
        private MessageBusInterface $eventBus,
    ) {
    }

    public function __invoke(Command $command): UserInterface
    {
        $entity = AdminUser::create(
            $this->repository->nextIdentity(),
            $command->getUsername(),
            $command->getEmail(),
        );

        $entity->updatePassword(
            $this->passwordEncoder->encodePassword($entity, $command->getPassword())
        );

        $this->repository->insert($entity);
        $this->eventBus->dispatch(new AdminWasRegistered($entity));

        return $entity;
    }
}
