<?php

declare(strict_types=1);

namespace Mono\Component\Space\Domain\Operation\Update\Exception;

use Mono\Component\Space\Domain\Common\Identifier\SpaceId;

final class UnableToUpdateException extends \Exception
{
    public function __construct(string $id)
    {
        parent::__construct(
            \Safe\sprintf('Space %s failed during Update process', $id)
        );
    }
}
