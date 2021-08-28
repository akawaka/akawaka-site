<?php

declare(strict_types=1);

namespace Mono\Bundle\AkaBundle\Shared\Infrastructure\Persistence\ORM\AdminSecurity;

use Mono\Bundle\AkaBundle\Shared\Domain\Entity\AdminPasswordRecovery;
use Doctrine\Persistence\ManagerRegistry;
use Mono\Bundle\AkaBundle\Shared\Domain\Entity\PasswordRecoveryInterface;
use Mono\Bundle\AkaBundle\Shared\Domain\Identifier\PasswordRecoveryId;
use Mono\Bundle\AkaBundle\Shared\Domain\Repository;
use Mono\Bundle\CoreBundle\Infrastructure\Persistence\Doctrine\ORMRepository;

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
