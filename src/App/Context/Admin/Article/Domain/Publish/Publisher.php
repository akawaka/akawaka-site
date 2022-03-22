<?php

declare(strict_types=1);

namespace App\Context\Admin\Article\Domain\Publish;

use App\Context\Admin\Article\Domain\Publish\DataPersister\PublishPersisterInterface;
use App\Context\Admin\Article\Domain\Publish\Exception\PublishFailedException;
use App\Shared\Domain\Identifier\ArticleId;

final class Publisher implements PublisherInterface
{
    public function __construct(
        private PublishPersisterInterface $persister,
    ) {
    }

    public function publish(ArticleId $id): void
    {
        $published = $this->persister->publish($id);

        if (false === $published) {
            throw new PublishFailedException($id);
        }
    }
}
