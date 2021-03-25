<?php

declare(strict_types=1);

namespace Black\Bundle\PeanutBundle\Application\Page\Gateway\FindPageBySlug;

use Black\Bundle\CoreBundle\Application\GatewayRequest;
use Symfony\Component\PropertyAccess\PropertyAccess;

final class FindPageBySlugRequest implements GatewayRequest
{
    private string $slug;

    public static function fromData(array $data = []): self
    {
        $dto = new self();
        $requiredFields = [
            'slug',
        ];

        $accessor = PropertyAccess::createPropertyAccessor();

        foreach ($requiredFields as $field) {
            $dto->{$field} = $accessor->getValue($data, "[$field]");
        }

        return $dto;
    }

    public function data(): array
    {
        return [
            'slug' => $this->getSlug(),
        ];
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }
}
