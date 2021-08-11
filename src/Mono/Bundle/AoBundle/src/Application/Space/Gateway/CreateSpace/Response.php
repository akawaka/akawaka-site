<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Application\Space\Gateway\CreateSpace;

use Mono\Bundle\AoBundle\Domain\Space\Common\Identifier\SpaceId;
use Mono\Component\Core\Application\Gateway\GatewayResponse;
use Mono\Bundle\AoBundle\Domain\Space\Operation\Create\Model\SpaceInterface;

final class Response implements GatewayResponse
{
    public function __construct(
        private SpaceId $id,
        private SpaceInterface $space,
    ) {
    }

    public function getId(): SpaceId
    {
        return $this->id;
    }

    public function getSpace(): SpaceInterface
    {
        return $this->space;
    }

    public function data(): array
    {
        $space = $this->getSpace();

        return [
            'identifier' => $this->getId()->getValue(),
            'code' => $space->getCode()->getValue(),
            'name' => $space->getName(),
            'status' => $space->getStatus(),
            'creationDate' => $space->getCreationDate()->format('Y-m-d H:i:s'),
        ];
    }
}
