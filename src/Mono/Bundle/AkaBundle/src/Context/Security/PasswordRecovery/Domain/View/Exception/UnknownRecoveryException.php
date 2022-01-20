<?php

declare(strict_types=1);

namespace Mono\Bundle\AkaBundle\Context\Security\PasswordRecovery\Domain\View\Exception;

final class UnknownRecoveryException extends \Exception
{
    public function __construct($identifier)
    {
        parent::__construct(
            \Safe\sprintf('Recovery with identifier %s is unknown', $identifier)
        );
    }
}
