<?php

declare(strict_types=1);

namespace App\CMS\Infrastructure\Persistence\ORM\Page;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Query\Parameter;
use Doctrine\Persistence\ManagerRegistry;
use Mono\Component\Core\Infrastructure\Persistence\Doctrine\ORMRepository;
use Mono\Component\Page\Domain\Entity\PageInterface;
use Mono\Component\Page\Domain\Repository;
use Mono\Component\Page\Domain\ValueObject\PageSlug;

final class FindPageBySlug extends ORMRepository implements Repository\FindPageBySlug
{
    public function __construct(ManagerRegistry $managerRegistry)
    {
        parent::__construct($managerRegistry, PageInterface::class);
    }

    public function find(PageSlug $slug): PageInterface
    {
        $query = $this->getQuery(<<<SQL
                SELECT page
                FROM {$this->getClassName()} page
                WHERE page.slug = :slug
            SQL);

        $query->setParameters(new ArrayCollection([
            new Parameter('slug', $slug->getValue()),
        ]));

        return $query->getSingleResult();
    }
}