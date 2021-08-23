<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Domain\Space\Operation\View;

use Mono\Bundle\AoBundle\Domain\Space\Common\Identifier\SpaceId;
use Mono\Bundle\AoBundle\Domain\Space\Common\ValueObject\SpaceCode;

interface ReaderInterface
{
    public function get(SpaceId $id): array;

    public function getByCode(SpaceCode $code): array;

    public function getByHostname(string $hostname): array;

    public function getAll(): array;
}
