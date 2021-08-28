<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Category\Domain\Delete;

use Mono\Bundle\AoBundle\Shared\Domain\Identifier\CategoryId;

interface DeleterInterface
{
    public function delete(CategoryId $id): void;
}
