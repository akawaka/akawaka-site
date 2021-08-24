<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Domain\Operation\Space\Delete\Exception;

use Mono\Bundle\AoBundle\Admin\Domain\Shared\Identifier\SpaceId;

final class SpaceWasNotDeleted extends \Exception
{
    public function __construct(SpaceId $id)
    {
        parent::__construct(
            \Safe\sprintf('Space %s failed during delete process', $id->getValue())
        );
    }
}
