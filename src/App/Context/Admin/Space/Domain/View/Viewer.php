<?php

declare(strict_types=1);

namespace App\Context\Admin\Space\Domain\View;

use App\Context\Admin\Space\Domain\View\DataProvider\Factory\BuilderInterface;
use App\Context\Admin\Space\Domain\View\DataProvider\Model\SpaceInterface;
use App\Context\Admin\Space\Domain\View\DataProvider\ViewProviderInterface;
use App\Context\Admin\Space\Domain\View\Exception\SpaceWasNotFound;
use App\Shared\Domain\Identifier\SpaceId;
use App\Shared\Domain\ValueObject\Code;

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
}
