<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Context\CRUD\Category\Domain\View;

use Mono\Bundle\AoBundle\Context\CRUD\Category\Domain\View\DataProvider\Model\CategoryInterface;
use Mono\Bundle\AoBundle\Shared\Domain\Identifier\CategoryId;
use Mono\Bundle\AoBundle\Shared\Domain\ValueObject\Slug;

interface ViewerInterface
{
    public function read(CategoryId $id): ?CategoryInterface;

    public function readBySlug(Slug $slug): ?CategoryInterface;
}
