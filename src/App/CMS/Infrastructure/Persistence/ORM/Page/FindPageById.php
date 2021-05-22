<?php

declare(strict_types=1);

namespace App\CMS\Infrastructure\Persistence\ORM\Page;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Query\Parameter;
use Doctrine\Persistence\ManagerRegistry;
use Mono\Component\Core\Infrastructure\Persistence\Doctrine\ORMRepository;
use Mono\Component\Page\Domain\Entity\PageInterface;
use Mono\Component\Page\Domain\Identifier\PageId;
use Mono\Component\Page\Domain\Repository;

final class FindPageById extends ORMRepository implements Repository\FindPageById
{
    public function __construct(ManagerRegistry $managerRegistry)
    {
        parent::__construct($managerRegistry, PageInterface::class);
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
