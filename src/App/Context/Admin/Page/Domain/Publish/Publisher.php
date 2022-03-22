<?php

declare(strict_types=1);

namespace App\Context\Admin\Page\Domain\Publish;

use App\Context\Admin\Page\Domain\Publish\DataPersister\PublishPersisterInterface;
use App\Context\Admin\Page\Domain\Publish\Exception\PublishFailedException;
use App\Shared\Domain\Identifier\PageId;

final class Publisher implements PublisherInterface
{
    public function __construct(
        private PublishPersisterInterface $persister,
    ) {
    }

    public function publish(PageId $id): void
    {
        $published = $this->persister->publish($id);

        if (false === $published) {
            throw new PublishFailedException($id);
        }
    }
}
