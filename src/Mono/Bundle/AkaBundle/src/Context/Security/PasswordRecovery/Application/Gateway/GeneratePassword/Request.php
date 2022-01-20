<?php

declare(strict_types=1);

namespace Mono\Bundle\AkaBundle\Context\Security\PasswordRecovery\Application\Gateway\GeneratePassword;

use Mono\Bundle\CoreBundle\Application\Gateway\GatewayRequest;
use Symfony\Component\PropertyAccess\PropertyAccess;

final class Request implements GatewayRequest
{
    private string $token;

    private string $password;

    public static function fromData(array $data = []): self
    {
        $dto = new self();
        $requiredFields = [
            'token',
        ];

        $accessor = PropertyAccess::createPropertyAccessor();
        foreach ($requiredFields as $field) {
            $dto->{$field} = $accessor->getValue($data, "[{$field}]");
        }

        return $dto;
    }

    public function getToken(): string
    {
        return $this->token;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function data(): array
    {
        return [
            'token' => $this->getToken(),
            'password' => $this->getPassword(),
        ];
    }
}
