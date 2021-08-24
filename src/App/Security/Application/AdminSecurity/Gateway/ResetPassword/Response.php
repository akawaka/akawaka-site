<?php

declare(strict_types=1);

namespace App\Security\Application\AdminSecurity\Gateway\ResetPassword;

use Mono\Component\AdminSecurity\Domain\Entity\PasswordRecoveryInterface;
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
            'user' => $passwordRecovery->getUser()->getId()->getValue(),
            'token' => $passwordRecovery->getToken(),
            'creation_date' => $passwordRecovery->getCreationDate()->format('Y-m-d H:i:s'),
        ];
    }
}
