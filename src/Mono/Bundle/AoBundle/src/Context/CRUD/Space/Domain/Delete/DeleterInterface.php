<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Context\CRUD\Space\Domain\Delete;

use Mono\Bundle\AoBundle\Shared\Domain\Identifier\SpaceId;

interface DeleterInterface
{
    public function delete(SpaceId $id): void;
}
