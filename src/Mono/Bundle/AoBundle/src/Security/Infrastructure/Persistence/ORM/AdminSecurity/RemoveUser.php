<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Security\Infrastructure\Persistence\ORM\AdminSecurity;

use Mono\Bundle\AoBundle\Security\Domain\Entity\AdminUser;
use Doctrine\Persistence\ManagerRegistry;
use Mono\Component\AdminSecurity\Domain\Entity\UserInterface;
use Mono\Component\AdminSecurity\Domain\Repository;
use Mono\Component\Core\Infrastructure\Persistence\Doctrine\ORMRepository;

final class RemoveUser extends ORMRepository implements Repository\RemoveUser
{
    public function __construct(ManagerRegistry $managerRegistry)
    {
        parent::__construct($managerRegistry, AdminUser::class);
    }

    public function remove(UserInterface $user): void
    {
        $this->manager->remove($user);
        $this->manager->flush();
    }
}
