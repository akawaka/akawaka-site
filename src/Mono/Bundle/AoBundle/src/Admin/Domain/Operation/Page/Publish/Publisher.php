<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Domain\Operation\Page\Publish;

use Mono\Bundle\AoBundle\Admin\Domain\Shared\Identifier\PageId;
use Mono\Bundle\AoBundle\Admin\Domain\Operation\Page\Publish\Exception\PublishFailedException;

final class Publisher implements PublisherInterface
{
    public function __construct(
        private WriterInterface $writer,
    ) {
    }

    public function publish(PageId $id): void
    {
        $published = $this->writer->publish($id);

        if (false === $published) {
            throw new PublishFailedException($id);
        }
    }
}
