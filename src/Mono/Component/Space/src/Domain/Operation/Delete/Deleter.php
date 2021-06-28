<?php

declare(strict_types=1);

namespace Mono\Component\Space\Domain\Operation\Delete;

use Mono\Component\Space\Domain\Operation\Delete\Exception\UnableToDeleteException;
use Mono\Component\Space\Domain\Common\Identifier\SpaceId;

final class Deleter implements DeleterInterface
{
    public function __construct(
        private WriterInterface $writer,
    ) {}

    public function delete(SpaceId $id): void
    {
        $deleted = $this->writer->delete($id);

        if (false === $deleted) {
            throw new UnableToDeleteException($id);
        }
    }
}
