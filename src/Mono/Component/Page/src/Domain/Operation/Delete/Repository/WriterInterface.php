<?php

declare(strict_types=1);

namespace Mono\Component\Page\Domain\Operation\Delete\Repository;

use Mono\Component\Page\Domain\Common\Identifier\PageId;

interface WriterInterface
{
    public function delete(PageId $id): bool;
}
