<?php

declare(strict_types=1);

namespace App\CMS\Application\Space\Gateway\CreateSpace;

use Mono\Component\Core\Application\Gateway\GatewayResponse;
use Mono\Component\Space\Domain\Operation\Create\Model\SpaceInterface;

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
        $space = $this->getSpace();

        return [
            'identifier' => $space->getId()->getValue(),
            'code' => $space->getCode()->getValue(),
            'name' => $space->getName(),
            'status' => $space->getStatus(),
            'creationDate' => $space->getCreationDate()->format('Y-m-d H:i:s'),
        ];
    }
}
