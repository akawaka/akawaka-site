<?php

declare(strict_types=1);

namespace Mono\Bundle\AkaBundle\Shared\Infrastructure\Persistence\ORM\AdminSecurity;

use Mono\Bundle\AkaBundle\Shared\Domain\Entity\AdminUser;
use Doctrine\Persistence\ManagerRegistry;
use Mono\Bundle\AkaBundle\Shared\Domain\Entity\UserInterface;
use Mono\Bundle\AkaBundle\Shared\Domain\Repository;
use Mono\Bundle\CoreBundle\Infrastructure\Persistence\Doctrine\ORMRepository;

final class UpdateUser extends ORMRepository implements Repository\UpdateUser
{
    public function __construct(ManagerRegistry $managerRegistry)
    {
        parent::__construct($managerRegistry, AdminUser::class);
    }

    public function update(UserInterface $user): void
    {
        $this->manager->flush();
    }
}
