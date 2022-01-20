<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Context\CRUD\Space\Domain\Publish\Exception;

use Mono\Bundle\AoBundle\Shared\Domain\Identifier\SpaceId;

final class SpaceWasNotPublished extends \Exception
{
    public function __construct(SpaceId $id)
    {
        parent::__construct(
            \Safe\sprintf('Space %s failed during publish process', $id->getValue())
        );
    }
}
