<?php

declare(strict_types=1);

namespace Mono\Component\Article\Domain\Operation\Category\Update;

use Mono\Component\Article\Domain\Operation\Category\Update\Exception\UnableToUpdateException;
use Mono\Component\Article\Domain\Operation\Category\Update\Model\CategoryInterface;
use Mono\Component\Article\Domain\Operation\Category\Update\Repository\WriterInterface;

final class Updater implements UpdaterInterface
{
    public function __construct(
        private WriterInterface $writer,
    ) {
    }

    public function update(CategoryInterface $category): void
    {
        try {
            $this->writer->update($category);
        } catch (\Exception $exception) {
            throw new UnableToUpdateException($category->getId()->getValue());
        }
    }
}
