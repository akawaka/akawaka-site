<?php

declare(strict_types=1);

namespace Mono\Component\Space\Domain\Operation\Close\Exception;

use Mono\Component\Space\Domain\Common\Identifier\SpaceId;

final class CloseFailedException extends \Exception
{
    public function __construct(SpaceId $id)
    {
        parent::__construct(
            \Safe\sprintf('Space %s failed during close process', $id->getValue())
        );
    }
}
