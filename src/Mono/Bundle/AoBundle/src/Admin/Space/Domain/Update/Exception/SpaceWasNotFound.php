<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Space\Domain\Update\Exception;

use Mono\Bundle\AoBundle\Shared\Domain\Identifier\SpaceId;

final class SpaceWasNotFound extends \Exception
{
    public function __construct(SpaceId $id)
    {
        parent::__construct(
            \Safe\sprintf('Space with identifier %s is unknown', $id->getValue())
        );
    }
}
