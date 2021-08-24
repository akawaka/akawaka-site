<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Domain\Operation\Space\Update\Repository;

use Mono\Bundle\AoBundle\Admin\Domain\Shared\Identifier\SpaceId;

interface WriterInterface
{
    public function update(
        SpaceId $id,
        string $name,
        ?string $url,
        ?string $description
    ): bool;
}
