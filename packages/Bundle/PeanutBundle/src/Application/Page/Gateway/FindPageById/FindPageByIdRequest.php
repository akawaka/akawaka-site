<?php

declare(strict_types=1);

namespace Black\Bundle\PeanutBundle\Application\Page\Gateway\FindPageById;

use Black\Bundle\CoreBundle\Application\GatewayRequest;
use Symfony\Component\PropertyAccess\PropertyAccess;

final class FindPageByIdRequest implements GatewayRequest
{
    private string $id;

    public static function fromData(array $data = []): self
    {
        $dto = new self();
        $requiredFields = [
            'id',
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
            'id' => $this->getId(),
        ];
    }

    public function getId(): ?string
    {
        return $this->id;
    }
}
