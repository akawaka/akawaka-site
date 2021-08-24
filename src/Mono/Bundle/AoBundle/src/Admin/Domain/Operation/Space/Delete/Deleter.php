<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Domain\Operation\Space\Delete;

use Mono\Bundle\AoBundle\Admin\Domain\Operation\Space\Delete\Exception\SpaceWasNotDeleted;
use Mono\Bundle\AoBundle\Admin\Domain\Shared\Identifier\SpaceId;
use Mono\Bundle\AoBundle\Admin\Domain\Operation\Space\Delete\Repository\WriterInterface;

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
