<?php

declare(strict_types=1);

namespace App\CMS\Infrastructure\Persistence\ORM\Channel;

use App\CMS\Domain\Entity\Channel;
use Doctrine\Persistence\ManagerRegistry;
use Mono\Component\Channel\Domain\Repository;
use Mono\Component\Core\Infrastructure\Persistence\Doctrine\DoctrineRepository;

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
