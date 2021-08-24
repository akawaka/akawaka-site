<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Domain\Operation\Space\Close\Exception;

use Mono\Bundle\AoBundle\Admin\Domain\Shared\Identifier\SpaceId;

final class SpaceWasNotClosed extends \Exception
{
    public function __construct(SpaceId $id)
    {
        parent::__construct(
            \Safe\sprintf('Space %s failed during close process', $id->getValue())
        );
    }
}
