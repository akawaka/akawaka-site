<?php

declare(strict_types=1);

namespace Mono\Bundle\AkaBundle\Admin\User\Domain\UpdatePassword\Exception;

final class UnableToUpdateException extends \Exception
{
    public function __construct(string $id)
    {
        parent::__construct(
            \Safe\sprintf('User %s failed during update process', $id)
        );
    }
}
