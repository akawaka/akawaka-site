<?php

declare(strict_types=1);

namespace Mono\Bundle\AkaBundle\Context\Security\User\Application\Gateway\FindUserByUsernameOrEmail;

use Mono\Bundle\AkaBundle\Shared\Domain\Model\UserInterface;
use Mono\Bundle\CoreBundle\Application\Gateway\GatewayResponse;

final class Response implements GatewayResponse
{
    public function __construct(
        private UserInterface $user
    ) {
    }

    public function getUser(): UserInterface
    {
        return $this->user;
    }

    public function data(): array
    {
        $user = $this->getUser();

        return [
            'identifier' => $user->getId()->getValue(),
            'username' => $user->getUsername(),
            'email' => $user->getEmail()->getValue(),
            'registration_date' => $user->getRegistrationDate()->format('Y-m-d H:i:s'),
            'lastUpdate' => null !== $user->getLastUpdate() ? $user->getLastUpdate()->format('Y-m-d H:i:s') : null,
            'lastConnection' => null !== $user->getLastConnection() ? $user->getLastConnection()->format('Y-m-d H:i:s') : null,
        ];
    }
}
