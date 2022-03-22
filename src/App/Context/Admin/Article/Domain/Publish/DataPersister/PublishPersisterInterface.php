<?php

declare(strict_types=1);

namespace App\Context\Admin\Article\Domain\Publish\DataPersister;

use App\Shared\Domain\Identifier\ArticleId;

interface PublishPersisterInterface
{
    public function publish(ArticleId $id): bool;
}
