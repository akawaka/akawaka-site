<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Space\Domain\View;

use Mono\Bundle\AoBundle\Shared\Domain\Identifier\SpaceId;
use Mono\Bundle\AoBundle\Shared\Domain\ValueObject\Code;
use Mono\Bundle\AoBundle\Admin\Space\Domain\View\Model\SpaceInterface;

interface ViewerInterface
{
    public function read(SpaceId $id): ?SpaceInterface;

    public function readByCode(Code $code): ?SpaceInterface;

    public function readByHostname(string $hostname): ?SpaceInterface;

    public function readAll(): array;
}
