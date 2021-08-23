<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Domain\Space\Operation\Delete;

use Mono\Bundle\AoBundle\Domain\Space\Common\Identifier\SpaceId;

interface DeleterInterface
{
    public function delete(SpaceId $id): void;
}
