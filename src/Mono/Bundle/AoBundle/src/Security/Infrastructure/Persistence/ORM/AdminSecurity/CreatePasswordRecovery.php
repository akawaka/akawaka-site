<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Security\Infrastructure\Persistence\ORM\AdminSecurity;

use Mono\Bundle\AoBundle\Security\Domain\Entity\AdminPasswordRecovery;
use Doctrine\Persistence\ManagerRegistry;
use Mono\Component\AdminSecurity\Domain\Entity\PasswordRecoveryInterface;
use Mono\Component\AdminSecurity\Domain\Identifier\PasswordRecoveryId;
use Mono\Component\AdminSecurity\Domain\Repository;
use Mono\Component\Core\Infrastructure\Persistence\Doctrine\ORMRepository;

final class CreatePasswordRecovery extends ORMRepository implements Repository\CreatePasswordRecovery
{
    public function __construct(ManagerRegistry $managerRegistry)
    {
        parent::__construct($managerRegistry, AdminPasswordRecovery::class);
    }

    public function insert(PasswordRecoveryInterface $passwordRecovery): void
    {
        $this->manager->persist($passwordRecovery);
        $this->manager->flush();
    }

    public function nextIdentity(): PasswordRecoveryId
    {
        return new PasswordRecoveryId();
    }
}
