<?php

declare(strict_types=1);

namespace App\CMS\Domain\Space\Operation\Publish;

use App\CMS\Domain\Space\Common\Identifier\SpaceId;

interface PublisherInterface
{
    public function publish(SpaceId $id): void;
}
