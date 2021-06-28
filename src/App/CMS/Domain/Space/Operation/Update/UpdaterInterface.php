<?php

declare(strict_types=1);

namespace App\CMS\Domain\Space\Operation\Update;

use App\CMS\Domain\Space\Common\Identifier\SpaceId;

interface UpdaterInterface
{
    public function update(
        SpaceId $id,
        string $name,
        ?string $url,
        ?string $description
    ): void;
}
