<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Security\Infrastructure\Persistence\ORM\AdminSecurity;

use Doctrine\Persistence\ManagerRegistry;
use Mono\Component\AdminSecurity\Domain\Entity\PasswordRecovery;
use Mono\Component\AdminSecurity\Domain\Entity\PasswordRecoveryInterface;
use Mono\Component\AdminSecurity\Domain\Repository;
use Mono\Component\Core\Infrastructure\Persistence\Doctrine\ORMRepository;

final class RemoveRecoverPassword extends ORMRepository implements Repository\RemoveRecoverPassword
{
    public function __construct(ManagerRegistry $managerRegistry)
    {
        parent::__construct($managerRegistry, PasswordRecovery::class);
    }

    public function remove(PasswordRecoveryInterface $recovery): void
    {
        $this->manager->remove($recovery);
        $this->manager->flush();
    }
}
