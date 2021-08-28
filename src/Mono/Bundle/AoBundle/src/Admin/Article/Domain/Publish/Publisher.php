<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Article\Domain\Publish;

use Mono\Bundle\AoBundle\Shared\Domain\Identifier\ArticleId;
use Mono\Bundle\AoBundle\Admin\Article\Domain\Publish\Exception\PublishFailedException;

final class Publisher implements PublisherInterface
{
    public function __construct(
        private WriterInterface $writer,
    ) {
    }

    public function publish(ArticleId $id): void
    {
        $published = $this->writer->publish($id);

        if (false === $published) {
            throw new PublishFailedException($id);
        }
    }
}
