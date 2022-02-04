<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Context\CRUD\Page\Domain\View\DataProvider;

use Mono\Bundle\AoBundle\Shared\Domain\Identifier\PageId;
use Mono\Bundle\AoBundle\Shared\Domain\ValueObject\Slug;

interface ViewProviderInterface
{
    public function get(PageId $id): array;

    public function getBySlug(Slug $slug): array;
}
