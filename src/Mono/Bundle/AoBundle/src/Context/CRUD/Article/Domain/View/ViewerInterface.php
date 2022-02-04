<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Context\CRUD\Article\Domain\View;

use Mono\Bundle\AoBundle\Context\CRUD\Article\Domain\View\DataProvider\Model\ArticleInterface;
use Mono\Bundle\AoBundle\Shared\Domain\Identifier\ArticleId;
use Mono\Bundle\AoBundle\Shared\Domain\ValueObject\Slug;

interface ViewerInterface
{
    public function read(ArticleId $id): ?ArticleInterface;

    public function readBySlug(Slug $slug): ?ArticleInterface;
}
