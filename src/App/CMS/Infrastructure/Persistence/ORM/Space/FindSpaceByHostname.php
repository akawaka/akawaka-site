<?php

declare(strict_types=1);

namespace App\CMS\Infrastructure\Persistence\ORM\Space;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Query\Parameter;
use Doctrine\Persistence\ManagerRegistry;
use Mono\Component\Space\Domain\Entity\SpaceInterface;
use Mono\Component\Space\Domain\Repository;
use Mono\Component\Core\Infrastructure\Persistence\Doctrine\ORMRepository;

final class FindSpaceByHostname extends ORMRepository implements Repository\FindSpaceByHostname
{
    public function __construct(ManagerRegistry $managerRegistry)
    {
        parent::__construct($managerRegistry, SpaceInterface::class);
    }

    public function find(string $hostname): SpaceInterface
    {
        $query = $this->getQuery(<<<SQL
                SELECT space
                FROM {$this->getClassName()} space
                WHERE space.url = :hostname
            SQL);

        $query->setParameters(new ArrayCollection([
            new Parameter('hostname', $hostname),
        ]));

        return $query->getSingleResult();
    }
}
