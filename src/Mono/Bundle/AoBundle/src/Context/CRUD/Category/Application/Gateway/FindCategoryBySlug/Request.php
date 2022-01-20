<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Context\CRUD\Category\Application\Gateway\FindCategoryBySlug;

use Mono\Bundle\CoreBundle\Application\Gateway\GatewayRequest;
use Symfony\Component\PropertyAccess\PropertyAccess;

final class Request implements GatewayRequest
{
    private string $slug;

    public static function fromData(array $data = []): self
    {
        $dto = new self();
        $fields = [
            'slug',
        ];

        $accessor = PropertyAccess::createPropertyAccessor();
        foreach ($fields as $field) {
            $dto->{$field} = $accessor->getValue($data, "[{$field}]");
        }

        return $dto;
    }

    public function getSlug(): string
    {
        return $this->slug;
    }

    public function data(): array
    {
        return [
            'slug' => $this->getSlug(),
        ];
    }
}
