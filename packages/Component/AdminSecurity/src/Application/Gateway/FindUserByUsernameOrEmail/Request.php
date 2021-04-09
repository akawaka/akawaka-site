<?php

declare(strict_types=1);

namespace Mono\Component\AdminSecurity\Application\Gateway\FindUserByUsernameOrEmail;

use Mono\Component\Core\Application\Gateway\GatewayRequest;
use JetBrains\PhpStorm\ArrayShape;
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
            $dto->{$field} = $accessor->getValue($data, "[$field]");
        }

        return $dto;
    }

    public function getUsernameOrEmail(): string
    {
        return $this->usernameOrEmail;
    }

    #[ArrayShape(['usernameOrEmail' => 'string'])]
    public function data(): array
    {
        return [
            'usernameOrEmail' => $this->getUsernameOrEmail(),
        ];
    }
}
