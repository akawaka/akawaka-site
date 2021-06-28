<?php

declare(strict_types=1);

namespace App\CMS\Domain\Space\Operation\Create\Exception;

use App\CMS\Domain\Space\Common\Identifier\SpaceId;

final class AlreadyExistingSpaceException extends \Exception
{
    public function __construct(SpaceId $id)
    {
        parent::__construct(
            \Safe\sprintf('Space with identifier %s already exist', $id->getValue())
        );
    }
}
