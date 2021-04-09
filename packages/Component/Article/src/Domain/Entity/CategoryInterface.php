<?php

declare(strict_types=1);

namespace Mono\Component\Article\Domain\Entity;

use Mono\Component\Article\Domain\Identifier\ArticleId;
use Mono\Component\Article\Domain\Identifier\CategoryId;
use Mono\Component\Article\Domain\ValueObject\Slug;
use Doctrine\Common\Collections\Collection;

interface CategoryInterface
{
    public function getId(): CategoryId;

    public function getName(): string;

    public function getSlug(): Slug;

    public function getArticles(): Collection;
}
