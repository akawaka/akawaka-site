<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Category\Domain\View;

use Mono\Bundle\AoBundle\Shared\Domain\Identifier\CategoryId;
use Mono\Bundle\AoBundle\Shared\Domain\ValueObject\Slug;
use Mono\Bundle\AoBundle\Admin\Category\Domain\View\Model\CategoryInterface;

interface ViewerInterface
{
    public function read(CategoryId $id): ?CategoryInterface;

    public function readBySlug(Slug $slug): ?CategoryInterface;

    public function readAll(): array;
}
