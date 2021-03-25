<?php

declare(strict_types=1);

namespace Black\Bundle\PeanutBundle\Application\Page\Gateway\FindPagesByStatus;

use Black\Bundle\CoreBundle\Application\GatewayRequest;
use Symfony\Component\PropertyAccess\PropertyAccess;

final class FindPagesByStatusRequest implements GatewayRequest
{
    private string $status;

    private int $page;

    public function __construct()
    {
        $this->page = 1;
    }

    public static function fromData(array $data = []): self
    {
        $dto = new self();
        $requiredFields = [
            'status',
        ];

        $optionalFields = [
            'page',
        ];

        $accessor = PropertyAccess::createPropertyAccessor();

        foreach ($requiredFields as $field) {
            $dto->{$field} = $accessor->getValue($data, "[$field]");
        }

        foreach ($optionalFields as $field) {
            if (null !== $accessor->getValue($data, "[$field]")) {
                $dto->{$field} = $accessor->getValue($data, "[$field]");
            }
        }

        return $dto;
    }

    public function data(): array
    {
        return [
            'status' => $this->getStatus(),
            'page' => $this->getPage(),
        ];
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function getPage(): int
    {
        return $this->page;
    }
}
