<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Domain\Operation\Space\Update;

use Mono\Bundle\AoBundle\Admin\Domain\Shared\Identifier\SpaceId;

interface UpdaterInterface
{
    public function update(
        SpaceId $id,
        string $name,
        ?string $url,
        ?string $description
    ): void;
}
