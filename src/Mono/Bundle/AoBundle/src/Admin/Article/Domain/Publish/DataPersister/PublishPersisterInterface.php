<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Article\Domain\Publish\DataPersister;

use Mono\Bundle\AoBundle\Shared\Domain\Identifier\ArticleId;

interface PublishPersisterInterface
{
    public function publish(ArticleId $id): bool;
}
