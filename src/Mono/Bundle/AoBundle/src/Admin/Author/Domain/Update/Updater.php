<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Author\Domain\Update;

use Mono\Bundle\AoBundle\Admin\Author\Domain\Update\DataPersister\Model\AuthorInterface;
use Mono\Bundle\AoBundle\Admin\Author\Domain\Update\DataPersister\UpdatePersisterInterface;
use Mono\Bundle\AoBundle\Admin\Author\Domain\Update\Exception\UnableToUpdateException;

final class Updater implements UpdaterInterface
{
    public function __construct(
        private UpdatePersisterInterface $persister,
    ) {
    }

    public function update(AuthorInterface $author): void
    {
        try {
            $this->persister->update($author);
        } catch (\Exception $exception) {
            throw new UnableToUpdateException($author->getId()->getValue());
        }
    }
}
