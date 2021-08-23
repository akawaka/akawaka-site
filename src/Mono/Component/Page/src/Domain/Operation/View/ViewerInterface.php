<?php

declare(strict_types=1);

namespace Mono\Component\Page\Domain\Operation\View;

use Mono\Component\Page\Domain\Common\Identifier\PageId;
use Mono\Component\Page\Domain\Common\ValueObject\PageSlug;
use Mono\Component\Page\Domain\Operation\View\Model\PageInterface;

interface ViewerInterface
{
    public function read(PageId $id): ?PageInterface;

    public function readBySlug(PageSlug $slug): ?PageInterface;

    public function readAll(): array;
}
