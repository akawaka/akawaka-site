<?php

declare(strict_types=1);

namespace App\CMS\Domain\Page\Operation\Publish;

use Mono\Component\Page\Domain\Common\Identifier\PageId;
use App\CMS\Domain\Page\Operation\Publish\Exception\PublishFailedException;

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
