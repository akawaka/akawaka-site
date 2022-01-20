<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Context\CRUD\Category\Domain\Delete\DataPersister;

use Mono\Bundle\AoBundle\Shared\Domain\Identifier\CategoryId;

interface DeletePersisterInterface
{
    public function delete(CategoryId $id): bool;
}
