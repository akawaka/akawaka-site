<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Context\CRUD\Space\Domain\View;

use Mono\Bundle\AoBundle\Context\CRUD\Space\Domain\View\DataProvider\Factory\BuilderInterface;
use Mono\Bundle\AoBundle\Context\CRUD\Space\Domain\View\DataProvider\Model\SpaceInterface;
use Mono\Bundle\AoBundle\Context\CRUD\Space\Domain\View\DataProvider\ViewProviderInterface;
use Mono\Bundle\AoBundle\Context\CRUD\Space\Domain\View\Exception\SpaceWasNotFound;
use Mono\Bundle\AoBundle\Shared\Domain\Identifier\SpaceId;
use Mono\Bundle\AoBundle\Shared\Domain\ValueObject\Code;

final class Viewer implements ViewerInterface
{
    public function __construct(
        private ViewProviderInterface $provider,
        private BuilderInterface $builder,
    ) {
    }

    public function read(SpaceId $id): SpaceInterface
    {
        $result = $this->provider->get($id);

        if ([] === $result) {
            throw new SpaceWasNotFound($id->getValue());
        }

        return $this->builder::build($result);
    }

    public function readByCode(Code $code): ?SpaceInterface
    {
        $result = $this->provider->getByCode($code);

        if ([] === $result) {
            throw new SpaceWasNotFound($code->getValue());
        }

        return $this->builder::build($result);
    }

    public function readByHostname(string $hostname): ?SpaceInterface
    {
        $result = $this->provider->getByHostname($hostname);

        if ([] === $result) {
            throw new SpaceWasNotFound($hostname);
        }

        return $this->builder::build($result);
    }

    public function readAll(): array
    {
        $collection = [];
        $results = $this->provider->getAll();

        foreach ($results as $result) {
            $collection[] = $this->builder::build($result);
        }

        return $collection;
    }
}
