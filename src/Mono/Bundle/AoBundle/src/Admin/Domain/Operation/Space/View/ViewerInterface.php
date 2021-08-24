<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Domain\Operation\Space\View;

use Mono\Bundle\AoBundle\Admin\Domain\Shared\Identifier\SpaceId;
use Mono\Bundle\AoBundle\Admin\Domain\Shared\ValueObject\Code;
use Mono\Bundle\AoBundle\Admin\Domain\Operation\Space\View\Model\SpaceInterface;

interface ViewerInterface
{
    public function read(SpaceId $id): ?SpaceInterface;

    public function readByCode(Code $code): ?SpaceInterface;

    public function readByHostname(string $hostname): ?SpaceInterface;

    public function readAll(): array;
}
