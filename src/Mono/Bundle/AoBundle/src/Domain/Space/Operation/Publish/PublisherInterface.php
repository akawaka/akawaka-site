<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Domain\Space\Operation\Publish;

use Mono\Bundle\AoBundle\Domain\Space\Common\Identifier\SpaceId;

interface PublisherInterface
{
    public function publish(SpaceId $id): void;
}
