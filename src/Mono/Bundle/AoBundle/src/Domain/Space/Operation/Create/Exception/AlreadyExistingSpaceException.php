<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Domain\Space\Operation\Create\Exception;

use Mono\Bundle\AoBundle\Domain\Space\Common\Identifier\SpaceId;

final class AlreadyExistingSpaceException extends \Exception
{
    public function __construct(SpaceId $id)
    {
        parent::__construct(
            \Safe\sprintf('Space with identifier %s already exist', $id->getValue())
        );
    }
}
