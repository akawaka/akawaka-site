<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Category\Domain\Update;

use Mono\Bundle\AoBundle\Admin\Category\Domain\Update\Exception\UnableToUpdateException;
use Mono\Bundle\AoBundle\Admin\Category\Domain\Update\Model\CategoryInterface;
use Mono\Bundle\AoBundle\Admin\Category\Domain\Update\Repository\WriterInterface;

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
