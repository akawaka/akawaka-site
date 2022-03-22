<?php

declare(strict_types=1);

namespace App\Context\Admin\Article\Domain\View;

use App\Context\Admin\Article\Domain\View\DataProvider\Model\ArticleInterface;
use App\Shared\Domain\Identifier\ArticleId;
use App\Shared\Domain\ValueObject\Slug;

interface ViewerInterface
{
    public function read(ArticleId $id): ?ArticleInterface;

    public function readBySlug(Slug $slug): ?ArticleInterface;
}
