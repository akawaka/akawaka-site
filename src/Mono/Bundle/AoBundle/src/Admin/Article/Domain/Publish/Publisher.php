<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Article\Domain\Publish;

use Mono\Bundle\AoBundle\Admin\Article\Domain\Publish\DataPersister\PublishPersisterInterface;
use Mono\Bundle\AoBundle\Admin\Article\Domain\Publish\Exception\PublishFailedException;
use Mono\Bundle\AoBundle\Shared\Domain\Identifier\ArticleId;

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
