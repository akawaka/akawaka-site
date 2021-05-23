<?php

declare(strict_types=1);

namespace App\CMS\Application\Space\Gateway\RemoveSpace;

use Mono\Component\Space\Domain\Entity\SpaceInterface;
use Mono\Component\Core\Application\Gateway\GatewayResponse;

final class Response implements GatewayResponse
{
    public function __construct(
        private SpaceInterface $space
    ) {
    }

    public function getSpace(): SpaceInterface
    {
        return $this->space;
    }

    public function data(): array
    {
        return [];
    }
}
