<?php

declare(strict_types=1);

namespace Mono\Component\Space\Domain\Operation\Create\Exception;

use Mono\Component\Space\Domain\Common\Identifier\SpaceId;

final class AlreadyExistingSpaceException extends \Exception
{
    public function __construct(SpaceId $id)
    {
        parent::__construct(
            \Safe\sprintf('Space with identifier %s already exist', $id->getValue())
        );
    }
}
