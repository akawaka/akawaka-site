<?php

declare(strict_types=1);

namespace App\Cms\Infrastructure\Persistence\ORM\Channel;

use App\Cms\Domain\Entity\Channel;
use Black\Component\Core\Infrastructure\Persistence\Doctrine\DoctrineRepository;
use Black\Component\Channel\Domain\Repository;
use Doctrine\Persistence\ManagerRegistry;

final class FindAll extends DoctrineRepository implements Repository\FindAll
{
    public function __construct(ManagerRegistry $managerRegistry)
    {
        parent::__construct($managerRegistry, Channel::class);
    }

    public function findAll(): array
    {
        $query = $this->getQuery(<<<SQL
            SELECT channel
            FROM {$this->getClassName()} channel
        SQL);

        return $query->execute();
    }
}
