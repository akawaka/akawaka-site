<?php

declare(strict_types=1);

namespace App\Security\Application\AdminSecurity\Gateway\UpdateUser;

use JetBrains\PhpStorm\ArrayShape;
use Mono\Component\Core\Application\Gateway\GatewayRequest;
use Symfony\Component\PropertyAccess\PropertyAccess;

final class Request implements GatewayRequest
{
    private string $identifier;

    private string $username;

    private string $email;

    public static function fromData(array $data = []): self
    {
        $dto = new self();
        $requiredFields = [
            'identifier',
            'username',
            'email',
        ];

        $accessor = PropertyAccess::createPropertyAccessor();
        foreach ($requiredFields as $field) {
            $dto->{$field} = $accessor->getValue($data, "[{$field}]");
        }

        return $dto;
    }

    public function getIdentifier(): string
    {
        return $this->identifier;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    #[ArrayShape(['identifier' => 'string', 'username' => 'string', 'email' => 'string'])]
    public function data(): array
    {
        return [
            'identifier' => $this->getIdentifier(),
            'username' => $this->getUsername(),
            'email' => $this->getEmail(),
        ];
    }
}