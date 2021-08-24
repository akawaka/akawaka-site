<?php

declare(strict_types=1);

namespace App\Security\Infrastructure\Persistence\ORM\AdminSecurity;

use Doctrine\Persistence\ManagerRegistry;
use App\Security\Domain\Entity\AdminPasswordRecovery;
use Mono\Component\AdminSecurity\Domain\Entity\PasswordRecoveryInterface;
use Mono\Component\AdminSecurity\Domain\Repository;
use Mono\Bundle\CoreBundle\Infrastructure\Persistence\Doctrine\ORMRepository;

final class RemoveRecoverPassword extends ORMRepository implements Repository\RemoveRecoverPassword
{
    public function __construct(ManagerRegistry $managerRegistry)
    {
        parent::__construct($managerRegistry, AdminPasswordRecovery::class);
    }

    public function remove(PasswordRecoveryInterface $recovery): void
    {
        $this->manager->remove($recovery);
        $this->manager->flush();
    }
}
