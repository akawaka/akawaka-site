<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Domain\Operation\Author\Update;

use Mono\Bundle\AoBundle\Admin\Domain\Operation\Author\Update\Exception\UnableToUpdateException;
use Mono\Bundle\AoBundle\Admin\Domain\Operation\Author\Update\Model\AuthorInterface;
use Mono\Bundle\AoBundle\Admin\Domain\Operation\Author\Update\Repository\WriterInterface;

final class Updater implements UpdaterInterface
{
    public function __construct(
        private WriterInterface $writer,
    ) {
    }

    public function update(AuthorInterface $author): void
    {
        try {
            $this->writer->update($author);
        } catch (\Exception $exception) {
            throw new UnableToUpdateException($author->getId()->getValue());
        }
    }
}
