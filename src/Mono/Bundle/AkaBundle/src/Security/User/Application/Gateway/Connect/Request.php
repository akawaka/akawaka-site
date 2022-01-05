<?php

declare(strict_types=1);

namespace Mono\Bundle\AkaBundle\Security\User\Application\Gateway\Connect;

use Mono\Bundle\CoreBundle\Application\Gateway\GatewayRequest;
use Symfony\Component\PropertyAccess\PropertyAccess;

final class Request implements GatewayRequest
{
    private string $username;

    public static function fromData(array $data = []): self
    {
        $dto = new self();
        $fields = [
            'username',
        ];

        $accessor = PropertyAccess::createPropertyAccessor();
        foreach ($fields as $field) {
            $dto->{$field} = $accessor->getValue($data, "[{$field}]");
        }

        return $dto;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function data(): array
    {
        return [
            'username' => $this->getUsername(),
        ];
    }
}
