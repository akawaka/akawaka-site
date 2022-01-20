<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Context\CRUD\Category\Domain\Delete;

use Mono\Bundle\AoBundle\Shared\Domain\Identifier\CategoryId;

interface DeleterInterface
{
    public function delete(CategoryId $id): void;
}
