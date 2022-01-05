<?php

declare(strict_types=1);

namespace Mono\Bundle\AkaBundle\Security\PasswordRecovery\Application\Gateway\FindPasswordRecoveryById;

use Mono\Bundle\AkaBundle\Security\PasswordRecovery\Domain\View\DataProvider\Model\RecoveryInterface;
use Mono\Bundle\CoreBundle\Application\Gateway\GatewayResponse;

final class Response implements GatewayResponse
{
    public function __construct(
        private RecoveryInterface $passwordRecovery
    ) {
    }

    public function getPasswordRecovery(): RecoveryInterface
    {
        return $this->passwordRecovery;
    }

    public function data(): array
    {
        $passwordRecovery = $this->getPasswordRecovery();

        return [
            'identifier' => $passwordRecovery->getId()->getValue(),
            'user' => [
                'username' => $passwordRecovery->getUsername(),
                'email' => $passwordRecovery->getEmail()->getValue(),
            ],
            'token' => $passwordRecovery->getToken(),
            'creationDate' => $passwordRecovery->getCreationDate()->format('Y-m-d H:i:s'),
        ];
    }
}
