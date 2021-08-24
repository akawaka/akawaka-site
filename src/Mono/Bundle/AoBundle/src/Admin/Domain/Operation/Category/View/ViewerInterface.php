<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Domain\Operation\Category\View;

use Mono\Bundle\AoBundle\Admin\Domain\Shared\Identifier\CategoryId;
use Mono\Bundle\AoBundle\Admin\Domain\Shared\ValueObject\Slug;
use Mono\Bundle\AoBundle\Admin\Domain\Operation\Category\View\Model\CategoryInterface;

interface ViewerInterface
{
    public function read(CategoryId $id): ?CategoryInterface;

    public function readBySlug(Slug $slug): ?CategoryInterface;

    public function readAll(): array;
}
