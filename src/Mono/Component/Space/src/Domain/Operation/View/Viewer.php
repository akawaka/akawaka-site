<?php

declare(strict_types=1);

namespace Mono\Component\Space\Domain\Operation\View;

use Mono\Component\Space\Domain\Common\Identifier\SpaceId;
use Mono\Component\Space\Domain\Common\ValueObject\SpaceCode;
use Mono\Component\Space\Domain\Operation\View\Exception\UnknownSpaceException;
use Mono\Component\Space\Domain\Operation\View\Factory\BuilderInterface;
use Mono\Component\Space\Domain\Operation\View\Model\SpaceInterface;

final class Viewer implements ViewerInterface
{
    public function __construct(
        private ReaderInterface $reader,
        private BuilderInterface $builder,
    ) {}

    public function read(SpaceId $id): SpaceInterface
    {
        $result = $this->reader->get($id);

        if ([] === $result) {
            throw new UnknownSpaceException($id->getValue());
        }

        return $this->builder::build($result);
    }

    public function readByCode(SpaceCode $code): ?SpaceInterface
    {
        $result = $this->reader->getByCode($code);

        if (null === $result) {
            throw new UnknownSpaceException($code->getValue());
        }

        return $this->builder::build($result);
    }

    public function readByHostname(string $hostname): ?SpaceInterface
    {
        $result = $this->reader->getByHostname($hostname);

        if (null === $result) {
            throw new UnknownSpaceException($hostname);
        }

        return $this->builder::build($result);
    }

    public function readAll(): array
    {
        $collection = [];
        $results = $this->reader->getAll();

        foreach ($results as $result) {
            $collection[] = $this->builder::build($result);
        }

        return $collection;
    }
}
