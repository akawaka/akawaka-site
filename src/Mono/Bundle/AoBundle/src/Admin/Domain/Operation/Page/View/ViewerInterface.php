<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Domain\Operation\Page\View;

use Mono\Bundle\AoBundle\Admin\Domain\Shared\Identifier\PageId;
use Mono\Bundle\AoBundle\Admin\Domain\Shared\ValueObject\Slug;
use Mono\Bundle\AoBundle\Admin\Domain\Operation\Page\View\Model\PageInterface;

interface ViewerInterface
{
    public function read(PageId $id): ?PageInterface;

    public function readBySlug(Slug $slug): ?PageInterface;

    public function readAll(): array;
}
