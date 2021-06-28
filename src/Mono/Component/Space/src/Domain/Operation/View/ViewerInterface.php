<?php

declare(strict_types=1);

namespace Mono\Component\Space\Domain\Operation\View;

use Mono\Component\Space\Domain\Common\Identifier\SpaceId;
use Mono\Component\Space\Domain\Common\ValueObject\SpaceCode;
use Mono\Component\Space\Domain\Operation\View\Model\SpaceInterface;

interface ViewerInterface
{
    public function read(SpaceId $id): ?SpaceInterface;

    public function readByCode(SpaceCode $code): ?SpaceInterface;

    public function readByHostname(string $hostname): ?SpaceInterface;

    public function readAll(): array;
}
