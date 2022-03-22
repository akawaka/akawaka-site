<?php

declare(strict_types=1);

namespace App\Context\Admin\Space\Application\Gateway\CreateSpace;

use App\Shared\Domain\Identifier\SpaceId;
use Mono\Bundle\CoreBundle\Application\Gateway\GatewayResponse;

final class Response implements GatewayResponse
{
    public function __construct(
        private SpaceId $id,
    ) {
    }

    public function getId(): SpaceId
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
