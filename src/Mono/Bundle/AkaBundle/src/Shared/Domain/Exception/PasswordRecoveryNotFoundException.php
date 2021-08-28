<?php

declare(strict_types=1);

namespace Mono\Bundle\AkaBundle\Shared\Domain\Exception;

final class PasswordRecoveryNotFoundException extends \Exception
{
    public function __construct(string $identifier)
    {
        parent::__construct(
            \Safe\sprintf('Recovery with id %s not found', $identifier)
        );
    }
}
