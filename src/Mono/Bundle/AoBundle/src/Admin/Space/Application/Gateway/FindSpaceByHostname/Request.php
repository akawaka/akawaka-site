<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Space\Application\Gateway\FindSpaceByHostname;

use Mono\Bundle\CoreBundle\Application\Gateway\GatewayRequest;
use Symfony\Component\PropertyAccess\PropertyAccess;

final class Request implements GatewayRequest
{
    private string $hostname;

    public static function fromData(array $data = []): self
    {
        $dto = new self();
        $fields = [
            'hostname',
        ];

        $accessor = PropertyAccess::createPropertyAccessor();
        foreach ($fields as $field) {
            $dto->{$field} = $accessor->getValue($data, "[{$field}]");
        }

        return $dto;
    }

    public function getHostname(): string
    {
        return $this->hostname;
    }

    public function data(): array
    {
        return [
            'hostname' => $this->getHostname(),
        ];
    }
}
