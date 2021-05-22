<?php

declare(strict_types=1);

namespace App\CMS\Infrastructure\Persistence\ORM\Space;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Query\Parameter;
use Doctrine\Persistence\ManagerRegistry;
use Mono\Component\Space\Domain\Entity\SpaceInterface;
use Mono\Component\Space\Domain\Identifier\SpaceId;
use Mono\Component\Space\Domain\Repository;
use Mono\Component\Core\Infrastructure\Persistence\Doctrine\ORMRepository;

final class FindSpaceById extends ORMRepository implements Repository\FindSpaceById
{
    public function __construct(ManagerRegistry $managerRegistry)
    {
        parent::__construct($managerRegistry, SpaceInterface::class);
    }

    public function find(SpaceId $id): SpaceInterface
    {
        $query = $this->getQuery(<<<SQL
                SELECT space
                FROM {$this->getClassName()} space
                WHERE space.id = :id
            SQL);

        $query->setParameters(new ArrayCollection([
            new Parameter('id', $id->getValue()),
        ]));

        return $query->getSingleResult();
    }
}
