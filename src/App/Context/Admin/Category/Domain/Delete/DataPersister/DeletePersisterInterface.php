<?php

declare(strict_types=1);

namespace App\Context\Admin\Category\Domain\Delete\DataPersister;

use App\Shared\Domain\Identifier\CategoryId;

interface DeletePersisterInterface
{
    public function delete(CategoryId $id): bool;
}
