<?php

declare(strict_types=1);

namespace App\Security\Infrastructure\Persistence\ORM\AdminSecurity;

use App\Security\Domain\Entity\AdminUser;
use Doctrine\Persistence\ManagerRegistry;
use Mono\Component\AdminSecurity\Domain\Repository;
use Mono\Component\Core\Infrastructure\Persistence\Doctrine\DoctrineRepository;

final class FindAllUsers extends DoctrineRepository implements Repository\FindAllUsers
{
    public function __construct(ManagerRegistry $managerRegistry)
    {
        parent::__construct($managerRegistry, AdminUser::class);
    }

    public function findAll(): array
    {
        $query = $this->getQuery(<<<SQL
                SELECT user
                FROM {$this->getClassName()} user
            SQL);

        return $query->execute();
    }
}
