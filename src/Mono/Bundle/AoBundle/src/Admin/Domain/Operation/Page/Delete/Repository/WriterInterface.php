<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Domain\Operation\Page\Delete\Repository;

use Mono\Bundle\AoBundle\Admin\Domain\Shared\Identifier\PageId;

interface WriterInterface
{
    public function delete(PageId $id): bool;
}
