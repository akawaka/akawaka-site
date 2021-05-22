<?php

declare(strict_types=1);

namespace App\CMS\Infrastructure\Persistence\ORM\Space;

use Doctrine\Persistence\ManagerRegistry;
use Mono\Component\Space\Domain\Entity\SpaceInterface;
use Mono\Component\Space\Domain\Repository;
use Mono\Component\Core\Infrastructure\Persistence\Doctrine\ORMRepository;

final class RemoveSpace extends ORMRepository implements Repository\RemoveSpace
{
    public function __construct(ManagerRegistry $managerRegistry)
    {
        parent::__construct($managerRegistry, SpaceInterface::class);
    }

    public function remove(SpaceInterface $space): void
    {
        $this->manager->remove($space);
        $this->manager->flush();
    }
}
