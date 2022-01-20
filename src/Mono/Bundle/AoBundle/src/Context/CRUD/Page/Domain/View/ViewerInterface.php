<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Context\CRUD\Page\Domain\View;

use Mono\Bundle\AoBundle\Context\CRUD\Page\Domain\View\DataProvider\Model\PageInterface;
use Mono\Bundle\AoBundle\Shared\Domain\Identifier\PageId;
use Mono\Bundle\AoBundle\Shared\Domain\ValueObject\Slug;

interface ViewerInterface
{
    public function read(PageId $id): ?PageInterface;

    public function readBySlug(Slug $slug): ?PageInterface;

    public function readAll(): array;
}
