<?php

declare(strict_types=1);

namespace Mono\Component\Space\Domain\Operation\Create;

use Mono\Component\Space\Domain\Common\Identifier\SpaceId;
use Mono\Component\Space\Domain\Operation\Create\Exception\UnableToCreateException;
use Mono\Component\Space\Domain\Operation\Create\Exception\AlreadyExistingSpaceException;
use Mono\Component\Space\Domain\Operation\Create\Model\SpaceInterface;

final class Creator implements CreatorInterface
{
    public function __construct(
        private ReaderInterface $reader,
        private WriterInterface $writer
    ) {}

    public function create(SpaceInterface $space): void
    {
        $exist = $this->reader->exists($space->getId());

        if (true === $exist) {
            throw new AlreadyExistingSpaceException($space->getId());
        }

        $written = $this->writer->create($space);

        if (false === $written) {
            throw new UnableToCreateException();
        }
    }

    public function nextIdentity(): SpaceId
    {
        return new SpaceId();
    }
}
