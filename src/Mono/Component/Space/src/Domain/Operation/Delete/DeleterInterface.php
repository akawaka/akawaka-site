<?php

declare(strict_types=1);

namespace Mono\Component\Space\Domain\Operation\Delete;

use Mono\Component\Space\Domain\Common\Identifier\SpaceId;

interface DeleterInterface
{
    public function delete(SpaceId $id): void;
}
