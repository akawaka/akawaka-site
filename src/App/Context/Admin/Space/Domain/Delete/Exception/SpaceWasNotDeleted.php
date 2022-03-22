<?php

declare(strict_types=1);

namespace App\Context\Admin\Space\Domain\Delete\Exception;

use App\Shared\Domain\Identifier\SpaceId;

final class SpaceWasNotDeleted extends \Exception
{
    public function __construct(SpaceId $id)
    {
        parent::__construct(
            \Safe\sprintf('Space %s failed during delete process', $id->getValue())
        );
    }
}
