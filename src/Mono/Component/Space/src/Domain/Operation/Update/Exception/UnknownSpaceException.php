<?php

declare(strict_types=1);

namespace Mono\Component\Space\Domain\Operation\Update\Exception;

use Mono\Component\Space\Domain\Common\Identifier\SpaceId;

final class UnknownSpaceException extends \Exception
{
    public function __construct(SpaceId $id)
    {
        parent::__construct(
            \Safe\sprintf('Space with identifier %s is unknown', $id->getValue())
        );
    }
}
