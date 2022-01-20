<?php

declare(strict_types=1);

namespace Mono\Bundle\AkaBundle\Context\Security\PasswordRecovery\Infrastructure\Persistence\Doctrine\ORM;

use Doctrine\ORM\ORMException;
use Mono\Bundle\AkaBundle\Context\Security\PasswordRecovery\Domain\GeneratePassword\DataPersister\GeneratePasswordPersisterInterface;
use Mono\Bundle\AkaBundle\Context\Security\PasswordRecovery\Domain\GeneratePassword\DataPersister\Model\PasswordRecoveryInterface;
use Mono\Bundle\AkaBundle\Shared\Infrastructure\Persistence\Doctrine\ORM\PasswordRecoveryRepository;

final class GeneratePasswordPersister implements GeneratePasswordPersisterInterface
{
    public function __construct(
        private PasswordRecoveryRepository $passwordRecoveryRepository,
    ) {
    }

    public function recover(PasswordRecoveryInterface $passwordRecovery): bool
    {
        $dbRecovery = $this->passwordRecoveryRepository->findByToken($passwordRecovery->getToken());
        $user = $dbRecovery->getUser();
        $user->updatePassword($passwordRecovery->getPassword());

        try {
            $this->passwordRecoveryRepository->flush();
        } catch (ORMException $exception) {
            return false;
        }

        return true;
    }
}
