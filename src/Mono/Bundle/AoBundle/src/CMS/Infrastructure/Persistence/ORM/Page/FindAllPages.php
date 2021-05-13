<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\CMS\Infrastructure\Persistence\ORM\Page;

use Doctrine\Persistence\ManagerRegistry;
use Mono\Component\Core\Infrastructure\Persistence\Doctrine\ORMRepository;
use Mono\Component\Page\Domain\Entity\PageInterface;
use Mono\Component\Page\Domain\Repository;

final class FindAllPages extends ORMRepository implements Repository\FindAllPages
{
    public function __construct(ManagerRegistry $managerRegistry)
    {
        parent::__construct($managerRegistry, PageInterface::class);
    }

    public function findAll(): array
    {
        $query = $this->getQuery(<<<SQL
                SELECT page
                FROM {$this->getClassName()} page
            SQL);

        return $query->execute();
    }
}
