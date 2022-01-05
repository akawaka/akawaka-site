<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Article\Domain\Update;

use Mono\Bundle\AoBundle\Admin\Article\Domain\Update\DataPersister\Model\ArticleInterface;
use Mono\Bundle\AoBundle\Admin\Article\Domain\Update\DataPersister\UpdatePersisterInterface;
use Mono\Bundle\AoBundle\Admin\Article\Domain\Update\Exception\UnableToUpdateException;

final class Updater implements UpdaterInterface
{
    public function __construct(
        private UpdatePersisterInterface $persister,
    ) {
    }

    public function update(ArticleInterface $article): void
    {
        try {
            $this->persister->update($article);
        } catch (\Exception $exception) {
            throw new UnableToUpdateException($article->getId()->getValue());
        }
    }
}
