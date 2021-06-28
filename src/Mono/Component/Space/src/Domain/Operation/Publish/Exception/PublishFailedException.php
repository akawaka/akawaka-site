<?php

declare(strict_types=1);

namespace Mono\Component\Space\Domain\Operation\Publish\Exception;

use Mono\Component\Space\Domain\Common\Identifier\SpaceId;

final class PublishFailedException extends \Exception
{
    public function __construct(SpaceId $id)
    {
        parent::__construct(
            \Safe\sprintf('Space %s failed during publish process', $id->getValue())
        );
    }
}
