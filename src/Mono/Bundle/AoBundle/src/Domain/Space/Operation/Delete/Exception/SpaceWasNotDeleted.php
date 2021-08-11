<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Domain\Space\Operation\Delete\Exception;

use Mono\Bundle\AoBundle\Domain\Space\Common\Identifier\SpaceId;

final class SpaceWasNotDeleted extends \Exception
{
    public function __construct(SpaceId $id)
    {
        parent::__construct(
            \Safe\sprintf('Space %s failed during delete process', $id->getValue())
        );
    }
}
