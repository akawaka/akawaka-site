<?php

declare(strict_types=1);

namespace Black\Bundle\PeanutBundle\Application\Page\Gateway\FindPages;

use Black\Bundle\CoreBundle\Application\GatewayRequest;
use Symfony\Component\PropertyAccess\PropertyAccess;

final class FindPagesRequest implements GatewayRequest
{
    private int $page;

    public function __construct()
    {
        $this->page = 1;
    }

    public static function fromData(array $data = []): self
    {
        $dto = new self();

        $optionalFields = [
            'page',
        ];

        $accessor = PropertyAccess::createPropertyAccessor();

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
            'page' => $this->getPage(),
        ];
    }

    public function getPage(): int
    {
        return $this->page;
    }
}
