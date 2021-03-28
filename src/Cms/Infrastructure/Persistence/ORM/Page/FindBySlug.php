<?php

declare(strict_types=1);

namespace App\Cms\Infrastructure\Persistence\ORM\Page;

use App\Cms\Domain\Entity\Page;
use Black\Component\Page\Domain\Entity\PageInterface;
use Black\Component\Page\Domain\ValueObject\PageSlug;
use Black\Component\Core\Infrastructure\Persistence\Doctrine\DoctrineRepository;
use Black\Component\Page\Domain\Repository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Query\Parameter;
use Doctrine\Persistence\ManagerRegistry;

final class FindBySlug extends DoctrineRepository implements Repository\FindBySlug
{
    public function __construct(ManagerRegistry $managerRegistry)
    {
        parent::__construct($managerRegistry, Page::class);
    }

    public function find(PageSlug $slug): PageInterface
    {
        $query = $this->getQuery(<<<SQL
            SELECT page
            FROM {$this->getClassName()} page
            WHERE page.slug = :slug
        SQL);

        $query->setParameters(new ArrayCollection([
            new Parameter('slug', $slug->getValue())
        ]));

        return $query->getSingleResult();
    }
}
