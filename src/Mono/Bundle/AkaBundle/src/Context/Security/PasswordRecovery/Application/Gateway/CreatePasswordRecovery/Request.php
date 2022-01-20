<?php

declare(strict_types=1);

namespace Mono\Bundle\AkaBundle\Context\Security\PasswordRecovery\Application\Gateway\CreatePasswordRecovery;

use Mono\Bundle\CoreBundle\Application\Gateway\GatewayRequest;
use Symfony\Component\PropertyAccess\PropertyAccess;

final class Request implements GatewayRequest
{
    private string $usernameOrEmail;

    public static function fromData(array $data = []): self
    {
        $dto = new self();
        $fields = [
            'usernameOrEmail',
        ];

        $accessor = PropertyAccess::createPropertyAccessor();
        foreach ($fields as $field) {
            $dto->{$field} = $accessor->getValue($data, "[{$field}]");
        }

        return $dto;
    }

    public function getUsernameOrEmail(): string
    {
        return $this->usernameOrEmail;
    }

    public function data(): array
    {
        return [
            'usernameOrEmail' => $this->getUsernameOrEmail(),
        ];
    }
}
