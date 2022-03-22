<?php

declare(strict_types=1);

namespace App\Context\Admin\Space\Domain\View\DataProvider;

use App\Shared\Domain\Identifier\SpaceId;
use App\Shared\Domain\ValueObject\Code;

interface ViewProviderInterface
{
    public function get(SpaceId $id): array;

    public function getByCode(Code $code): array;

    public function getByHostname(string $hostname): array;
}
