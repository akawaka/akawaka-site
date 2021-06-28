<?php

declare(strict_types=1);

namespace App\CMS\Domain\Article\Operation\Publish;

use Mono\Component\Article\Domain\Common\Identifier\ArticleId;
use App\CMS\Domain\Article\Operation\Publish\Exception\PublishFailedException;

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
