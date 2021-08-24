<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Domain\Operation\Space\View;

use Mono\Bundle\AoBundle\Admin\Domain\Shared\Identifier\SpaceId;
use Mono\Bundle\AoBundle\Admin\Domain\Shared\ValueObject\Code;

interface ReaderInterface
{
    public function get(SpaceId $id): array;

    public function getByCode(Code $code): array;

    public function getByHostname(string $hostname): array;

    public function getAll(): array;
}
