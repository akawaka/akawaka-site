<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Domain\Operation\Category\Delete;

use Mono\Bundle\AoBundle\Admin\Domain\Shared\Identifier\CategoryId;

interface DeleterInterface
{
    public function delete(CategoryId $id): void;
}
