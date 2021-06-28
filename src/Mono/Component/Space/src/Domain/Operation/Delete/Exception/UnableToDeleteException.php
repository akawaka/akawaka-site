<?php

declare(strict_types=1);

namespace Mono\Component\Space\Domain\Operation\Delete\Exception;

use Mono\Component\Space\Domain\Common\Identifier\SpaceId;

final class UnableToDeleteException extends \Exception
{
    public function __construct(SpaceId $id)
    {
        parent::__construct(
            \Safe\sprintf('Space %s failed during delete process', $id->getValue())
        );
    }
}
