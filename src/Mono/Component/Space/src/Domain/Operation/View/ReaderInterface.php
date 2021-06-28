<?php

declare(strict_types=1);

namespace Mono\Component\Space\Domain\Operation\View;

use Mono\Component\Space\Domain\Common\Identifier\SpaceId;
use Mono\Component\Space\Domain\Common\ValueObject\SpaceCode;

interface ReaderInterface
{
    public function get(SpaceId $id): array;

    public function getByCode(SpaceCode $code): array;

    public function getByHostname(string $hostname): array;

    public function getAll(): array;
}
