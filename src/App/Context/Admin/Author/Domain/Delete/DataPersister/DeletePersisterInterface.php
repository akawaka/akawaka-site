<?php

declare(strict_types=1);

namespace App\Context\Admin\Author\Domain\Delete\DataPersister;

use App\Shared\Domain\Identifier\AuthorId;

interface DeletePersisterInterface
{
    public function delete(AuthorId $id): bool;
}
