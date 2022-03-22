<?php

declare(strict_types=1);

namespace App\Context\Admin\Page\Domain\View;

use App\Context\Admin\Page\Domain\View\DataProvider\Model\PageInterface;
use App\Shared\Domain\Identifier\PageId;
use App\Shared\Domain\ValueObject\Slug;

interface ViewerInterface
{
    public function read(PageId $id): ?PageInterface;

    public function readBySlug(Slug $slug): ?PageInterface;

    public function readAll(): array;
}
