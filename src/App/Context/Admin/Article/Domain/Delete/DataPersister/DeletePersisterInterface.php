<?php

declare(strict_types=1);

namespace App\Context\Admin\Article\Domain\Delete\DataPersister;

use App\Shared\Domain\Identifier\ArticleId;

interface DeletePersisterInterface
{
    public function delete(ArticleId $id): bool;
}
