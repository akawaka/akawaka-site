<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Context\CRUD\Page\Domain\Update;

use Mono\Bundle\AoBundle\Context\CRUD\Page\Domain\Update\DataPersister\Model\PageInterface;
use Mono\Bundle\AoBundle\Context\CRUD\Page\Domain\Update\DataPersister\UpdatePersisterInterface;
use Mono\Bundle\AoBundle\Context\CRUD\Page\Domain\Update\Exception\UnableToUpdateException;

final class Updater implements UpdaterInterface
{
    public function __construct(
        private UpdatePersisterInterface $persister,
    ) {
    }

    public function update(PageInterface $page): void
    {
        try {
            $this->persister->update($page);
        } catch (\Exception $exception) {
            throw new UnableToUpdateException($page->getId()->getValue());
        }
    }
}
