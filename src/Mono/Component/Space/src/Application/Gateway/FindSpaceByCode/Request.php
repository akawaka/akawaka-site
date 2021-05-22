<?php

declare(strict_types=1);

namespace Mono\Component\Space\Application\Gateway\FindSpaceByCode;

use JetBrains\PhpStorm\ArrayShape;
use Mono\Component\Core\Application\Gateway\GatewayRequest;
use Symfony\Component\PropertyAccess\PropertyAccess;

final class Request implements GatewayRequest
{
    private string $code;

    public static function fromData(array $data = []): self
    {
        $dto = new self();
        $fields = [
            'code',
        ];

        $accessor = PropertyAccess::createPropertyAccessor();
        foreach ($fields as $field) {
            $dto->{$field} = $accessor->getValue($data, "[{$field}]");
        }

        return $dto;
    }

    public function getCode(): string
    {
        return $this->code;
    }

    #[ArrayShape(['code' => 'string'])]
    public function data(): array
    {
        return [
            'code' => $this->getCode(),
        ];
    }
}
