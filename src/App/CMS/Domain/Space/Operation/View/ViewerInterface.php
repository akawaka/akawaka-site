<?php

declare(strict_types=1);

namespace App\CMS\Domain\Space\Operation\View;

use App\CMS\Domain\Space\Common\Identifier\SpaceId;
use App\CMS\Domain\Space\Common\ValueObject\SpaceCode;
use App\CMS\Domain\Space\Operation\View\Model\SpaceInterface;

interface ViewerInterface
{
    public function read(SpaceId $id): ?SpaceInterface;

    public function readByCode(SpaceCode $code): ?SpaceInterface;

    public function readByHostname(string $hostname): ?SpaceInterface;

    public function readAll(): array;
}
