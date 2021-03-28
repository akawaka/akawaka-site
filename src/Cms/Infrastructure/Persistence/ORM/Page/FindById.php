<?php

declare(strict_types=1);

namespace App\Cms\Infrastructure\Persistence\ORM\Page;

use App\Cms\Domain\Entity\Page;
use Black\Component\Page\Domain\Entity\PageInterface;
use Black\Component\Page\Domain\Identifier\PageId;
use Black\Component\Core\Infrastructure\Persistence\Doctrine\DoctrineRepository;
use Black\Component\Page\Domain\Repository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Query\Parameter;
use Doctrine\Persistence\ManagerRegistry;

final class FindById extends DoctrineRepository implements Repository\FindById
{
    public function __construct(ManagerRegistry $managerRegistry)
    {
        parent::__construct($managerRegistry, Page::class);
    }

    public function find(PageId $id): PageInterface
    {
        $query = $this->getQuery(<<<SQL
            SELECT page
            FROM {$this->getClassName()} page
            WHERE page.id = :id
        SQL);

        $query->setParameters(new ArrayCollection([
            new Parameter('id', $id->getValue())
        ]));

        return $query->getSingleResult();
    }
}
