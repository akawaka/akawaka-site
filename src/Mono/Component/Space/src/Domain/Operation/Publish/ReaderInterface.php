<?php

declare(strict_types=1);

namespace Mono\Component\Space\Domain\Operation\Publish;

use Mono\Component\Space\Domain\Common\Identifier\SpaceId;

interface ReaderInterface
{
    public function exists(SpaceId $id): bool;
}
