<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Page\Domain\Update;

use Mono\Bundle\AoBundle\Admin\Page\Domain\Update\Exception\UnableToUpdateException;
use Mono\Bundle\AoBundle\Admin\Page\Domain\Update\Model\PageInterface;
use Mono\Bundle\AoBundle\Admin\Page\Domain\Update\Repository\WriterInterface;

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
