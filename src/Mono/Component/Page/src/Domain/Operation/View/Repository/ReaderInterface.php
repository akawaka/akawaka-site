<?php

declare(strict_types=1);

namespace Mono\Component\Page\Domain\Operation\View\Repository;

use Mono\Component\Page\Domain\Common\Identifier\PageId;
use Mono\Component\Page\Domain\Common\ValueObject\PageSlug;

interface ReaderInterface
{
    public function get(PageId $id): array;

    public function getBySlug(PageSlug $slug): array;

    public function getAll(): array;
}
