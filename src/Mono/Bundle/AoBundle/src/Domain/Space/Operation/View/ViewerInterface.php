<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Domain\Space\Operation\View;

use Mono\Bundle\AoBundle\Domain\Space\Common\Identifier\SpaceId;
use Mono\Bundle\AoBundle\Domain\Space\Common\ValueObject\SpaceCode;
use Mono\Bundle\AoBundle\Domain\Space\Operation\View\Model\SpaceInterface;

interface ViewerInterface
{
    public function read(SpaceId $id): ?SpaceInterface;

    public function readByCode(SpaceCode $code): ?SpaceInterface;

    public function readByHostname(string $hostname): ?SpaceInterface;

    public function readAll(): array;
}
