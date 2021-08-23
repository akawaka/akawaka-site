<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Domain\Space\Operation\Update\Repository;

use Mono\Bundle\AoBundle\Domain\Space\Common\Identifier\SpaceId;

interface WriterInterface
{
    public function update(
        SpaceId $id,
        string $name,
        ?string $url,
        ?string $description
    ): bool;
}
