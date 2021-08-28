<?php

declare(strict_types=1);

namespace Mono\Bundle\AkaBundle\Shared\Infrastructure\Persistence\ORM\AdminSecurity;

use Mono\Bundle\AkaBundle\Shared\Domain\Entity\AdminUser;
use Doctrine\Persistence\ManagerRegistry;
use Mono\Bundle\AkaBundle\Shared\Domain\Repository;
use Mono\Bundle\CoreBundle\Infrastructure\Persistence\Doctrine\ORMRepository;

final class FindAllUsers extends ORMRepository implements Repository\FindAllUsers
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
