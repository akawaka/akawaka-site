<?php

declare(strict_types=1);

namespace App\CMS\Domain\Space\Operation\View;

use App\CMS\Domain\Space\Common\Identifier\SpaceId;
use App\CMS\Domain\Space\Common\ValueObject\SpaceCode;

interface ReaderInterface
{
    public function get(SpaceId $id): array;

    public function getByCode(SpaceCode $code): array;

    public function getByHostname(string $hostname): array;

    public function getAll(): array;
}
