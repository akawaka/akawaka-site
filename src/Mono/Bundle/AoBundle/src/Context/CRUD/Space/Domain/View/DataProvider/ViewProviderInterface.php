<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Context\CRUD\Space\Domain\View\DataProvider;

use Mono\Bundle\AoBundle\Shared\Domain\Identifier\SpaceId;
use Mono\Bundle\AoBundle\Shared\Domain\ValueObject\Code;

interface ViewProviderInterface
{
    public function get(SpaceId $id): array;

    public function getByCode(Code $code): array;

    public function getByHostname(string $hostname): array;
}
