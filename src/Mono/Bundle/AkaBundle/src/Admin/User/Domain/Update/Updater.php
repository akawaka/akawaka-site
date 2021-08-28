<?php

declare(strict_types=1);

namespace Mono\Bundle\AkaBundle\Admin\User\Domain\Update;

use Mono\Bundle\AkaBundle\Admin\User\Domain\Update\Exception\UnableToUpdateException;
use Mono\Bundle\AkaBundle\Admin\User\Domain\Update\Model\UserInterface;
use Mono\Bundle\AkaBundle\Admin\User\Domain\Update\Repository\WriterInterface;

final class Updater implements UpdaterInterface
{
    public function __construct(
        private WriterInterface $writer,
    ) {
    }

    public function update(UserInterface $User): void
    {
        try {
            $this->writer->update($User);
        } catch (\Exception $exception) {
            throw new UnableToUpdateException($User->getId()->getValue());
        }
    }
}
