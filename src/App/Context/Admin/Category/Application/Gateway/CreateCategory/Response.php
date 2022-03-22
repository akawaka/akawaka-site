<?php

declare(strict_types=1);

namespace App\Context\Admin\Category\Application\Gateway\CreateCategory;

use App\Shared\Domain\Identifier\CategoryId;
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
