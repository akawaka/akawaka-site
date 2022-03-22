<?php

declare(strict_types=1);

namespace App\Context\Admin\Space\Domain\Publish;

use App\Shared\Domain\Identifier\SpaceId;

interface PublisherInterface
{
    public function publish(SpaceId $id): void;
}
