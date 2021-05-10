<?php

declare(strict_types=1);

namespace Mono\Component\Article\Domain\Entity;

use Doctrine\Common\Collections\Collection;
use Mono\Component\Article\Domain\Identifier\CategoryId;
use Mono\Component\Article\Domain\ValueObject\Slug;

interface CategoryInterface
{
    public function getId(): CategoryId;

    public function getName(): string;

    public function getSlug(): Slug;

    public function getArticles(): Collection;
}
