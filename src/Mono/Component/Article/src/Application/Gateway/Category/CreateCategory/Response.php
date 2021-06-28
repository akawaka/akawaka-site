<?php

declare(strict_types=1);

namespace Mono\Component\Article\Application\Gateway\Category\CreateCategory;

use Mono\Component\Article\Domain\Common\Identifier\CategoryId;
use Mono\Component\Core\Application\Gateway\GatewayResponse;

final class Response implements GatewayResponse
{
    public function __construct(
        private CategoryId $id,
        private bool $success
    ) {
    }

    public function getId(): CategoryId
    {
        return $this->id;
    }

    public function getSuccess(): bool
    {
        return $this->success;
    }

    public function data(): array
    {
        return [
            'identifier' => $this->getId()->getValue(),
            'success' => $this->getSuccess(),
        ];
    }
}
