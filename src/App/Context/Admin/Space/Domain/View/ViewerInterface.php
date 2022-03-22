<?php

declare(strict_types=1);

namespace App\Context\Admin\Space\Domain\View;

use App\Context\Admin\Space\Domain\View\DataProvider\Model\SpaceInterface;
use App\Shared\Domain\Identifier\SpaceId;
use App\Shared\Domain\ValueObject\Code;

interface ViewerInterface
{
    public function read(SpaceId $id): ?SpaceInterface;

    public function readByCode(Code $code): ?SpaceInterface;

    public function readByHostname(string $hostname): ?SpaceInterface;
}
