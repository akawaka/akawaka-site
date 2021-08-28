<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Page\Domain\View\Repository;

use Mono\Bundle\AoBundle\Shared\Domain\Identifier\PageId;
use Mono\Bundle\AoBundle\Shared\Domain\ValueObject\Slug;

interface ReaderInterface
{
    public function get(PageId $id): array;

    public function getBySlug(Slug $slug): array;

    public function getAll(): array;
}
