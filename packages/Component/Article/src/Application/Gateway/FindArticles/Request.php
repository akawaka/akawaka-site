<?php

declare(strict_types=1);

namespace Mono\Component\Article\Application\Gateway\FindArticles;

use Mono\Component\Core\Application\Gateway\GatewayRequest;
use JetBrains\PhpStorm\ArrayShape;
use Symfony\Component\PropertyAccess\PropertyAccess;

final class Request implements GatewayRequest
{
    public static function fromData(array $data = []): self
    {
        $dto = new self();
        $fields = [];

        $accessor = PropertyAccess::createPropertyAccessor();
        foreach ($fields as $field) {
            $dto->{$field} = $accessor->getValue($data, "[$field]");
        }

        return $dto;
    }

    #[ArrayShape([])]
    public function data(): array
    {
        return [];
    }
}
