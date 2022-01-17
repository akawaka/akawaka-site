<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Space\Domain\Update;

use Mono\Bundle\AoBundle\Shared\Domain\Identifier\SpaceId;

interface UpdaterInterface
{
    public function update(
        SpaceId $id,
        string $name,
        ?string $url,
        ?string $description,
        ?string $theme
    ): void;
}
