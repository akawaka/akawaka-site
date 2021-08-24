<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Domain\Operation\Article\Update;

use Mono\Bundle\AoBundle\Admin\Domain\Operation\Article\Update\Exception\UnableToUpdateException;
use Mono\Bundle\AoBundle\Admin\Domain\Operation\Article\Update\Model\ArticleInterface;
use Mono\Bundle\AoBundle\Admin\Domain\Operation\Article\Update\Repository\WriterInterface;

final class Updater implements UpdaterInterface
{
    public function __construct(
        private WriterInterface $writer,
    ) {
    }

    public function update(ArticleInterface $article): void
    {
        try {
            $this->writer->update($article);
        } catch (\Exception $exception) {
            throw new UnableToUpdateException($article->getId()->getValue());
        }
    }
}
