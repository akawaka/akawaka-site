<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Domain\Operation\Space\Publish;

use Mono\Bundle\AoBundle\Admin\Domain\Shared\Identifier\SpaceId;

interface PublisherInterface
{
    public function publish(SpaceId $id): void;
}
