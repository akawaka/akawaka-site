<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Page\Domain\View;

use Mono\Bundle\AoBundle\Shared\Domain\Identifier\PageId;
use Mono\Bundle\AoBundle\Shared\Domain\ValueObject\Slug;
use Mono\Bundle\AoBundle\Admin\Page\Domain\View\Model\PageInterface;

interface ViewerInterface
{
    public function read(PageId $id): ?PageInterface;

    public function readBySlug(Slug $slug): ?PageInterface;

    public function readAll(): array;
}
