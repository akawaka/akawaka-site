<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Domain\Space\Operation\View;

use Mono\Bundle\AoBundle\Domain\Space\Common\Identifier\SpaceId;
use Mono\Bundle\AoBundle\Domain\Space\Common\ValueObject\SpaceCode;
use Mono\Bundle\AoBundle\Domain\Space\Operation\View\Exception\SpaceWasNotFound;
use Mono\Bundle\AoBundle\Domain\Space\Operation\View\Factory\BuilderInterface;
use Mono\Bundle\AoBundle\Domain\Space\Operation\View\Model\SpaceInterface;

final class Viewer implements ViewerInterface
{
    public function __construct(
        private ReaderInterface $reader,
        private BuilderInterface $builder,
    ) {
    }

    public function read(SpaceId $id): SpaceInterface
    {
        $result = $this->reader->get($id);

        if ([] === $result) {
            throw new SpaceWasNotFound($id->getValue());
        }

        return $this->builder::build($result);
    }

    public function readByCode(SpaceCode $code): ?SpaceInterface
    {
        $result = $this->reader->getByCode($code);

        if (null === $result) {
            throw new SpaceWasNotFound($code->getValue());
        }

        return $this->builder::build($result);
    }

    public function readByHostname(string $hostname): ?SpaceInterface
    {
        $result = $this->reader->getByHostname($hostname);

        if (null === $result) {
            throw new SpaceWasNotFound($hostname);
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
