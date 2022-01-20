<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Context\CRUD\Author\Application\Gateway\CreateAuthor;

use Mono\Bundle\AoBundle\Shared\Domain\Identifier\AuthorId;
use Mono\Bundle\CoreBundle\Application\Gateway\GatewayResponse;

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
