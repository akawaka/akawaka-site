<?php

declare(strict_types=1);

namespace Black\Bundle\PeanutBundle\Domain\Repository;

use Black\Bundle\PeanutBundle\Domain\Entity\Page\Page;

interface FindPageBySlugRepository
{
    public function findPageBySlug(string $slug): ?Page;
}
