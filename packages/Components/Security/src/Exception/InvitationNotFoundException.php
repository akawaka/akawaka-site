<?php

declare(strict_types=1);

namespace Black\Component\Security\Exception;

final class InvitationNotFoundException extends \Exception
{
    public function __construct(string $identifier)
    {
        parent::__construct(
            \Safe\sprintf('Invitation with id %s not found', $identifier)
        );
    }
}
