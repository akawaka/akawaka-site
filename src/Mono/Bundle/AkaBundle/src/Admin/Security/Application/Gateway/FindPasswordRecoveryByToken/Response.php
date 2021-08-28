<?php

declare(strict_types=1);

namespace Mono\Bundle\AkaBundle\Admin\Security\Application\Gateway\FindPasswordRecoveryByToken;

use Mono\Bundle\AkaBundle\Shared\Domain\Entity\PasswordRecoveryInterface;
use Mono\Bundle\CoreBundle\Application\Gateway\GatewayResponse;

final class Response implements GatewayResponse
{
    public function __construct(
        private PasswordRecoveryInterface $passwordRecovery
    ) {
    }

    public function getPasswordRecovery(): PasswordRecoveryInterface
    {
        return $this->passwordRecovery;
    }

    public function data(): array
    {
        $passwordRecovery = $this->getPasswordRecovery();

        return [
            'identifier' => $passwordRecovery->getId()->getValue(),
            'user' => [
                'identifier' => $passwordRecovery->getUser()->getId()->getValue(),
                'username' => $passwordRecovery->getUser()->getUsername(),
            ],
            'token' => $passwordRecovery->getToken(),
            'creationDate' => $passwordRecovery->getCreationDate()->format('Y-m-d H:i:s'),
        ];
    }
}
