<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Domain\Space\Operation\Publish\Exception;

use Mono\Bundle\AoBundle\Domain\Space\Common\Identifier\SpaceId;

final class SpaceWasNotPublished extends \Exception
{
    public function __construct(SpaceId $id)
    {
        parent::__construct(
            \Safe\sprintf('Space %s failed during publish process', $id->getValue())
        );
    }
}
