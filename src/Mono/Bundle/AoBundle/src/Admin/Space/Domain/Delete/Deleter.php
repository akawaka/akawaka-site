<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Space\Domain\Delete;

use Mono\Bundle\AoBundle\Admin\Space\Domain\Delete\Exception\SpaceWasNotDeleted;
use Mono\Bundle\AoBundle\Shared\Domain\Identifier\SpaceId;
use Mono\Bundle\AoBundle\Admin\Space\Domain\Delete\Repository\WriterInterface;

final class Deleter implements DeleterInterface
{
    public function __construct(
        private WriterInterface $writer,
    ) {
    }

    public function delete(SpaceId $id): void
    {
        try {
            $this->writer->delete($id);
        } catch (\Exception $exception) {
            throw new SpaceWasNotDeleted($id);
        }
    }
}
