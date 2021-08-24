<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Application\Category\Gateway\CreateCategory;

use Mono\Bundle\AoBundle\Admin\Domain\Shared\Identifier\CategoryId;
use Mono\Bundle\CoreBundle\Application\Gateway\GatewayResponse;

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
