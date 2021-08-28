<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Category\Domain\Delete\Repository;

use Mono\Bundle\AoBundle\Shared\Domain\Identifier\CategoryId;

interface WriterInterface
{
    public function delete(CategoryId $id): bool;
}
