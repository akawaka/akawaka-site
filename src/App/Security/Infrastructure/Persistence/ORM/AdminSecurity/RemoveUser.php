<?php

declare(strict_types=1);

namespace App\Security\Infrastructure\Persistence\ORM\AdminSecurity;

use App\Security\Domain\Entity\AdminUser;
use Doctrine\Persistence\ManagerRegistry;
use Mono\Component\AdminSecurity\Domain\Entity\UserInterface;
use Mono\Component\AdminSecurity\Domain\Repository;
use Mono\Bundle\CoreBundle\Infrastructure\Persistence\Doctrine\ORMRepository;

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
