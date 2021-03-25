<?php

declare(strict_types=1);

namespace Black\Bundle\PeanutBundle\Domain\Repository;

use Black\Bundle\PeanutBundle\Domain\Entity\Page\Page;
use Black\Bundle\PeanutBundle\Domain\Identifier\PageId;

interface FindPageByIdRepository
{
    public function findPageById(PageId $id): ?Page;
}
