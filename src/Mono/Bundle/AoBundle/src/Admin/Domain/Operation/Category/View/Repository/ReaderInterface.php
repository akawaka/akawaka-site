<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Domain\Operation\Category\View\Repository;

use Mono\Bundle\AoBundle\Admin\Domain\Shared\Identifier\CategoryId;
use Mono\Bundle\AoBundle\Admin\Domain\Shared\ValueObject\Slug;

interface ReaderInterface
{
    public function get(CategoryId $id): array;

    public function getBySlug(Slug $slug): array;

    public function getAll(): array;
}
