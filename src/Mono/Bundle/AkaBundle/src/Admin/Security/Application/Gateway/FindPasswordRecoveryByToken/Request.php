<?php

declare(strict_types=1);

namespace Mono\Bundle\AkaBundle\Admin\Security\Application\Gateway\FindPasswordRecoveryByToken;

use JetBrains\PhpStorm\ArrayShape;
use Mono\Bundle\CoreBundle\Application\Gateway\GatewayRequest;
use Symfony\Component\PropertyAccess\PropertyAccess;

final class Request implements GatewayRequest
{
    private string $token;

    public static function fromData(array $data = []): self
    {
        $dto = new self();
        $fields = [
            'token',
        ];

        $accessor = PropertyAccess::createPropertyAccessor();
        foreach ($fields as $field) {
            $dto->{$field} = $accessor->getValue($data, "[{$field}]");
        }

        return $dto;
    }

    public function getToken(): string
    {
        return $this->token;
    }

    #[ArrayShape(['token' => 'string'])]
    public function data(): array
    {
        return [
            'token' => $this->getToken(),
        ];
    }
}
