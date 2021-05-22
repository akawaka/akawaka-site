<?php

declare(strict_types=1);

namespace App\CMS\Infrastructure\Persistence\ORM\Space;

use Doctrine\Persistence\ManagerRegistry;
use Mono\Component\Space\Domain\Entity\SpaceInterface;
use Mono\Component\Space\Domain\Repository;
use Mono\Component\Core\Infrastructure\Persistence\Doctrine\ORMRepository;

final class FindAllSpaces extends ORMRepository implements Repository\FindAllSpaces
{
    public function __construct(ManagerRegistry $managerRegistry)
    {
        parent::__construct($managerRegistry, SpaceInterface::class);
    }

    public function findAll(): array
    {
        $query = $this->getQuery(<<<SQL
                SELECT space
                FROM {$this->getClassName()} space
            SQL);

        return $query->execute();
    }
}
