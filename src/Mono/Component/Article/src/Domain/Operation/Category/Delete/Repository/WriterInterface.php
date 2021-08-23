<?php

declare(strict_types=1);

namespace Mono\Component\Article\Domain\Operation\Category\Delete\Repository;

use Mono\Component\Article\Domain\Common\Identifier\CategoryId;

interface WriterInterface
{
    public function delete(CategoryId $id): bool;
}
