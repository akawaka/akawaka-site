<?php

declare(strict_types=1);

namespace App\Security\Application\AdminSecurity\Gateway\ResetPassword;

use Mono\Component\Core\Application\Gateway\GatewayRequest;
use Symfony\Component\PropertyAccess\PropertyAccess;

final class Request implements GatewayRequest
{
    private string $email;

    public static function fromData(array $data = []): self
    {
        $dto = new self();
        $fields = [
            'email',
        ];

        $accessor = PropertyAccess::createPropertyAccessor();
        foreach ($fields as $field) {
            $dto->{$field} = $accessor->getValue($data, "[{$field}]");
        }

        return $dto;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function data(): array
    {
        return [
            'email' => $this->getEmail(),
        ];
    }
}
