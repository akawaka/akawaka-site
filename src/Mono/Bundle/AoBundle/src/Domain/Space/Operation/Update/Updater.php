<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Domain\Space\Operation\Update;

use Mono\Bundle\AoBundle\Domain\Space\Common\Identifier\SpaceId;
use Mono\Bundle\AoBundle\Domain\Space\Operation\Update\Exception\SpaceWasNotUpdated;
use Mono\Bundle\AoBundle\Domain\Space\Operation\Update\Repository\WriterInterface;

final class Updater implements UpdaterInterface
{
    public function __construct(
        private WriterInterface $writer,
    ) {
    }

    public function update(
        SpaceId $id,
        string $name,
        ?string $url,
        ?string $description
    ): void {
        try {
            $this->writer->update(
                $id,
                $name,
                $url,
                $description,
            );
        } catch (\Exception $exception) {
            throw new SpaceWasNotUpdated($id->getValue());
        }
    }
}
