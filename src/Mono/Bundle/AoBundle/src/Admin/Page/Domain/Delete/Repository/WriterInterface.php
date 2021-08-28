<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Page\Domain\Delete\Repository;

use Mono\Bundle\AoBundle\Shared\Domain\Identifier\PageId;

interface WriterInterface
{
    public function delete(PageId $id): bool;
}
