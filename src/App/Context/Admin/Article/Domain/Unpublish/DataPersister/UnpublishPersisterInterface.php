<?php

declare(strict_types=1);

namespace App\Context\Admin\Article\Domain\Unpublish\DataPersister;

use App\Shared\Domain\Identifier\ArticleId;

interface UnpublishPersisterInterface
{
    public function close(ArticleId $id): bool;
}
