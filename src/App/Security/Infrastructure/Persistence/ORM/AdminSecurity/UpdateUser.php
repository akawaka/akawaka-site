<?php

declare(strict_types=1);

namespace App\Security\Infrastructure\Persistence\ORM\AdminSecurity;

use App\Security\Domain\Entity\AdminUser;
use Doctrine\Persistence\ManagerRegistry;
use Mono\Component\AdminSecurity\Domain\Repository;
use Mono\Component\Core\Infrastructure\Persistence\Doctrine\DoctrineRepository;
use Symfony\Component\Security\Core\User\UserInterface;

final class UpdateUser extends DoctrineRepository implements Repository\UpdateUser
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
