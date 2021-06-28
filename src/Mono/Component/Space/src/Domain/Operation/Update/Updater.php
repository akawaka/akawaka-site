<?php

declare(strict_types=1);

namespace Mono\Component\Space\Domain\Operation\Update;

use Mono\Component\Space\Domain\Common\Identifier\SpaceId;
use Mono\Component\Space\Domain\Operation\Update\Exception\UnableToUpdateException;
use Mono\Component\Space\Domain\Operation\Update\Exception\UnknownSpaceException;
use Mono\Component\Space\Domain\Operation\Update\Model\SpaceInterface;

final class Updater implements UpdaterInterface
{
    public function __construct(
        private ReaderInterface $reader,
        private WriterInterface $writer,
    ) {}

    public function update(
        SpaceId $id,
        string $name,
        ?string $url,
        ?string $description
    ): void {
        $exist = $this->reader->exists($id);

        if (false === $exist) {
            throw new UnknownSpaceException($id);
        }

        $updated = $this->writer->update(
            $id,
            $name,
            $url,
            $description,
        );

        if (false === $updated) {
            throw new UnableToUpdateException($id->getValue());
        }
    }
}
