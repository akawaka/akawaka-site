<?php

declare(strict_types=1);

namespace App\CMS\Infrastructure\Persistence\ORM\Space;

use Doctrine\Persistence\ManagerRegistry;
use Mono\Component\Space\Domain\Entity\SpaceInterface;
use Mono\Component\Space\Domain\Repository;
use Mono\Component\Core\Infrastructure\Persistence\Doctrine\ORMRepository;

final class UpdateSpace extends ORMRepository implements Repository\UpdateSpace
{
    public function __construct(ManagerRegistry $managerRegistry)
    {
        parent::__construct($managerRegistry, SpaceInterface::class);
    }

    public function update(SpaceInterface $space): void
    {
        $this->manager->flush();
    }
}
