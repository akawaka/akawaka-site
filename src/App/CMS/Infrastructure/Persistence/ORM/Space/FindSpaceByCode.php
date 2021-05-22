<?php

declare(strict_types=1);

namespace App\CMS\Infrastructure\Persistence\ORM\Space;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Query\Parameter;
use Doctrine\Persistence\ManagerRegistry;
use Mono\Component\Space\Domain\Entity\SpaceInterface;
use Mono\Component\Space\Domain\Repository;
use Mono\Component\Space\Domain\ValueObject\SpaceCode;
use Mono\Component\Core\Infrastructure\Persistence\Doctrine\ORMRepository;

final class FindSpaceByCode extends ORMRepository implements Repository\FindSpaceByCode
{
    public function __construct(ManagerRegistry $managerRegistry)
    {
        parent::__construct($managerRegistry, SpaceInterface::class);
    }

    public function find(SpaceCode $code): SpaceInterface
    {
        $query = $this->getQuery(<<<SQL
                SELECT space
                FROM {$this->getClassName()} space
                WHERE space.code = :code
            SQL);

        $query->setParameters(new ArrayCollection([
            new Parameter('code', $code->getValue()),
        ]));

        return $query->getSingleResult();
    }
}
