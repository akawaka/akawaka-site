<?php

declare(strict_types=1);

namespace App\CMS\Domain\Space\Operation\Delete;

use App\CMS\Domain\Space\Operation\Delete\Exception\SpaceWasNotDeleted;
use App\CMS\Domain\Space\Common\Identifier\SpaceId;
use App\CMS\Domain\Space\Operation\Delete\Repository\WriterInterface;

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
