<?php

declare(strict_types=1);

namespace App\CMS\Domain\Space\Operation\Delete;

use App\CMS\Domain\Space\Common\Identifier\SpaceId;

interface DeleterInterface
{
    public function delete(SpaceId $id): void;
}
