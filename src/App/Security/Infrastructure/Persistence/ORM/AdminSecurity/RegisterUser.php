<?php

declare(strict_types=1);

namespace App\Security\Infrastructure\Persistence\ORM\AdminSecurity;

use App\Security\Domain\Entity\AdminUser;
use Doctrine\Persistence\ManagerRegistry;
use Mono\Component\AdminSecurity\Domain\Entity\UserInterface;
use Mono\Component\AdminSecurity\Domain\Identifier\UserId;
use Mono\Component\AdminSecurity\Domain\Repository;
use Mono\Bundle\CoreBundle\Infrastructure\Persistence\Doctrine\ORMRepository;

final class RegisterUser extends ORMRepository implements Repository\CreateUser
{
    public function __construct(ManagerRegistry $managerRegistry)
    {
        parent::__construct($managerRegistry, AdminUser::class);
    }

    public function insert(UserInterface $user): void
    {
        $this->manager->persist($user);
        $this->manager->flush();
    }

    public function nextIdentity(): UserId
    {
        return new UserId();
    }
}
