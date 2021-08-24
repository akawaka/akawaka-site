<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Domain\Operation\Space\Delete;

use Mono\Bundle\AoBundle\Admin\Domain\Shared\Identifier\SpaceId;

interface DeleterInterface
{
    public function delete(SpaceId $id): void;
}
