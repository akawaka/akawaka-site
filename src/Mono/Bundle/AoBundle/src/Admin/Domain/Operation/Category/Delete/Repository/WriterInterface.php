<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Domain\Operation\Category\Delete\Repository;

use Mono\Bundle\AoBundle\Admin\Domain\Shared\Identifier\CategoryId;

interface WriterInterface
{
    public function delete(CategoryId $id): bool;
}
