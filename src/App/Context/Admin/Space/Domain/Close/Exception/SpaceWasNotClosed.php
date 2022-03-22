<?php

declare(strict_types=1);

namespace App\Context\Admin\Space\Domain\Close\Exception;

use App\Shared\Domain\Identifier\SpaceId;

final class SpaceWasNotClosed extends \Exception
{
    public function __construct(SpaceId $id)
    {
        parent::__construct(
            \Safe\sprintf('Space %s failed during close process', $id->getValue())
        );
    }
}
