<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Space\Domain\Update\DataPersister;

use Mono\Bundle\AoBundle\Shared\Domain\Identifier\SpaceId;

interface UpdatePersisterInterface
{
    public function update(
        SpaceId $id,
        string $name,
        ?string $url,
        ?string $description,
        ?string $theme,
    ): bool;
}
