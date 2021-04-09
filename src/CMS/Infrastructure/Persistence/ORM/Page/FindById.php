<?php

declare(strict_types=1);

namespace App\CMS\Infrastructure\Persistence\ORM\Page;

use App\CMS\Domain\Entity\Page;
use Mono\Component\Core\Infrastructure\Persistence\Doctrine\DoctrineRepository;
use Mono\Component\Page\Domain\Entity\PageInterface;
use Mono\Component\Page\Domain\Identifier\PageId;
use Mono\Component\Page\Domain\Repository;
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
            new Parameter('id', $id->getValue()),
        ]));

        return $query->getSingleResult();
    }
}
