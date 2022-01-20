<?php

declare(strict_types=1);

namespace Mono\Bundle\AkaBundle\Context\CRUD\User\Domain\Delete\Exception;

use Mono\Bundle\AkaBundle\Shared\Domain\Identifier\UserId;

final class UnableToDeleteException extends \Exception
{
    public function __construct(UserId $id)
    {
        parent::__construct(
            \Safe\sprintf('User %s failed during delete process', $id->getValue())
        );
    }
}
