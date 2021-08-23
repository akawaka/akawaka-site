<?php

declare(strict_types=1);

namespace Mono\Component\Article\Domain\Operation\Category\View;

use Mono\Component\Article\Domain\Common\Identifier\CategoryId;
use Mono\Component\Article\Domain\Common\ValueObject\Slug;
use Mono\Component\Article\Domain\Operation\Category\View\Model\CategoryInterface;

interface ViewerInterface
{
    public function read(CategoryId $id): ?CategoryInterface;

    public function readBySlug(Slug $slug): ?CategoryInterface;

    public function readAll(): array;
}
