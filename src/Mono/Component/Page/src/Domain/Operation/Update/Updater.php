<?php

declare(strict_types=1);

namespace Mono\Component\Page\Domain\Operation\Update;

use Mono\Component\Page\Domain\Operation\Update\Exception\UnableToUpdateException;
use Mono\Component\Page\Domain\Operation\Update\Model\PageInterface;
use Mono\Component\Page\Domain\Operation\Update\Repository\WriterInterface;

final class Updater implements UpdaterInterface
{
    public function __construct(
        private WriterInterface $writer,
    ) {
    }

    public function update(PageInterface $page): void
    {
        try {
            $this->writer->update($page);
        } catch (\Exception $exception) {
            throw new UnableToUpdateException($page->getId()->getValue());
        }
    }
}
