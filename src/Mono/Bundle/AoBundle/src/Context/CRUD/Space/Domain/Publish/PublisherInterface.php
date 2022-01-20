<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Context\CRUD\Space\Domain\Publish;

use Mono\Bundle\AoBundle\Shared\Domain\Identifier\SpaceId;

interface PublisherInterface
{
    public function publish(SpaceId $id): void;
}
