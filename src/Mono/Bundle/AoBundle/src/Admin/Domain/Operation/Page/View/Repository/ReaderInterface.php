<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Domain\Operation\Page\View\Repository;

use Mono\Bundle\AoBundle\Admin\Domain\Shared\Identifier\PageId;
use Mono\Bundle\AoBundle\Admin\Domain\Shared\ValueObject\Slug;

interface ReaderInterface
{
    public function get(PageId $id): array;

    public function getBySlug(Slug $slug): array;

    public function getAll(): array;
}
