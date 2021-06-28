<?php

declare(strict_types=1);

namespace App\CMS\Infrastructure\Persistence\ORM\Space;

use Doctrine\Persistence\ManagerRegistry;
use Mono\Component\Space\Domain\Entity\SpaceInterface;
use Mono\Component\Space\Domain\Identifier\SpaceId;
use Mono\Component\Space\Domain\Repository;
use Mono\Component\Core\Infrastructure\Persistence\Doctrine\ORMRepository;

final class CreateSpaceRepository extends ORMRepository implements Repository\CreateSpaceRepository
{
    public function __construct(ManagerRegistry $managerRegistry)
    {
        parent::__construct($managerRegistry, SpaceInterface::class);
    }

    public function insert(SpaceInterface $space): void
    {
        $this->manager->persist($space);
        $this->manager->flush();
    }

    public function nextIdentity(): SpaceId
    {
        return new SpaceId();
    }
}
