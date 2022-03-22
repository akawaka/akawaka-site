<?php

declare(strict_types=1);

namespace App\Context\Admin\Space\Domain\Delete;

use App\Shared\Domain\Identifier\SpaceId;

interface DeleterInterface
{
    public function delete(SpaceId $id): void;
}
