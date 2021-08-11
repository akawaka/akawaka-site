<?php

declare(strict_types=1);

namespace Mono\Component\Article\Application\Gateway\Author\CreateAuthor;

use Mono\Component\Article\Domain\Common\Identifier\AuthorId;
use Mono\Component\Core\Application\Gateway\GatewayResponse;

final class Response implements GatewayResponse
{
    public function __construct(
        private AuthorId $id,
    ) {
    }

    public function getId(): AuthorId
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
