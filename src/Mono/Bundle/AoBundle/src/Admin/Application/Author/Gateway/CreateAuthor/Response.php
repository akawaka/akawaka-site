<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Application\Author\Gateway\CreateAuthor;

use Mono\Bundle\AoBundle\Admin\Domain\Shared\Identifier\AuthorId;
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
