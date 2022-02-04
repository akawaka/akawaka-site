<?php

declare(strict_types=1);

namespace Mono\Bundle\AkaBundle\Context\Security\PasswordRecovery\Infrastructure\Persistence\Doctrine\ORM;

use Mono\Bundle\AkaBundle\Context\Security\PasswordRecovery\Domain\Create\DataPersister\CreatePersisterInterface;
use Mono\Bundle\AkaBundle\Context\Security\PasswordRecovery\Domain\Create\DataPersister\Model\RecoveryInterface;
use Mono\Bundle\AkaBundle\Shared\Infrastructure\Persistence\Doctrine\ORM\AdminUserRepository;
use Mono\Bundle\AkaBundle\Shared\Infrastructure\Persistence\Doctrine\ORM\PasswordRecoveryRepository;

final class CreatePersister implements CreatePersisterInterface
{
    public function __construct(
        private AdminUserRepository $userRepository,
        private PasswordRecoveryRepository $passwordRecoveryRepository,
    ) {
    }

    public function create(RecoveryInterface $recovery): bool
    {
        $dbUser = $this->userRepository->findByUsernameOrEmail($recovery->getUsernameOrEmail());

        $dbRecovery = $this->passwordRecoveryRepository->getClass();
        $dbRecovery->create($recovery->getId(), $dbUser);

        $this->passwordRecoveryRepository->persist($dbRecovery);
    }
}
