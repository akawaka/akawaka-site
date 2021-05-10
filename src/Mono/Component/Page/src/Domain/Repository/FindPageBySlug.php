<?php

declare(strict_types=1);

namespace Mono\Component\Page\Domain\Repository;

use Mono\Component\Page\Domain\Entity\PageInterface;
use Mono\Component\Page\Domain\ValueObject\PageSlug;

interface FindPageBySlug
{
    public function find(PageSlug $slug): ?PageInterface;
}
