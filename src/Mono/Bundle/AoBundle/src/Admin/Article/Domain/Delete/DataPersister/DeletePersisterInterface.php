<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Article\Domain\Delete\DataPersister;

use Mono\Bundle\AoBundle\Shared\Domain\Identifier\ArticleId;

interface DeletePersisterInterface
{
    public function delete(ArticleId $id): bool;
}
