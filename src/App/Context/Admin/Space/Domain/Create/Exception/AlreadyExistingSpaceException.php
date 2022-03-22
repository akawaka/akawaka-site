<?php

declare(strict_types=1);

namespace App\Context\Admin\Space\Domain\Create\Exception;

use App\Shared\Domain\Identifier\SpaceId;

final class AlreadyExistingSpaceException extends \Exception
{
    public function __construct(SpaceId $id)
    {
        parent::__construct(
            \Safe\sprintf('Space with identifier %s already exist', $id->getValue())
        );
    }
}
