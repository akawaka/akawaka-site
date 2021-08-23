<?php

declare(strict_types=1);

namespace Mono\Component\Article\Application\Gateway\Category\CreateCategory;

use Mono\Component\Article\Domain\Common\Identifier\CategoryId;
use Mono\Component\Core\Application\Gateway\GatewayResponse;

final class Response implements GatewayResponse
{
    public function __construct(
        private CategoryId $id,
    ) {
    }

    public function getId(): CategoryId
    {
        return $this->id;
    }

    public function data(): array
    {
        return [
            'identifier' => $this->getId()->getValue(),
        ];
    }
}
