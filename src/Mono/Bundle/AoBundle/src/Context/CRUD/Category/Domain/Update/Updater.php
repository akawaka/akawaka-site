<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Context\CRUD\Category\Domain\Update;

use Mono\Bundle\AoBundle\Context\CRUD\Category\Domain\Update\DataPersister\Model\CategoryInterface;
use Mono\Bundle\AoBundle\Context\CRUD\Category\Domain\Update\DataPersister\UpatePersisterInterface;
use Mono\Bundle\AoBundle\Context\CRUD\Category\Domain\Update\Exception\UnableToUpdateException;

final class Updater implements UpdaterInterface
{
    public function __construct(
        private UpatePersisterInterface $persister,
    ) {
    }

    public function update(CategoryInterface $category): void
    {
        try {
            $this->persister->update($category);
        } catch (\Exception $exception) {
            throw new UnableToUpdateException($category->getId()->getValue());
        }
    }
}
