<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Category\Domain\View\DataProvider;

use Mono\Bundle\AoBundle\Shared\Domain\Identifier\CategoryId;
use Mono\Bundle\AoBundle\Shared\Domain\ValueObject\Slug;

interface ViewProviderInterface
{
    public function get(CategoryId $id): array;

    public function getBySlug(Slug $slug): array;

    public function getAll(): array;
}
