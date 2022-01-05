<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Article\Domain\Unpublish\DataPersister;

use Mono\Bundle\AoBundle\Shared\Domain\Identifier\ArticleId;

interface UnpublishPersisterInterface
{
    public function close(ArticleId $id): bool;
}
