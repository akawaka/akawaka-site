<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Space\Domain\View;

use Mono\Bundle\AoBundle\Shared\Domain\Identifier\SpaceId;
use Mono\Bundle\AoBundle\Shared\Domain\ValueObject\Code;

interface ReaderInterface
{
    public function get(SpaceId $id): array;

    public function getByCode(Code $code): array;

    public function getByHostname(string $hostname): array;

    public function getAll(): array;
}
