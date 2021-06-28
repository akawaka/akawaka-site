<?php

declare(strict_types=1);

namespace App\CMS\Application\Space\Gateway\CreateSpace;

use App\CMS\Domain\Space\Common\Identifier\SpaceId;
use Mono\Component\Core\Application\Gateway\GatewayResponse;
use App\CMS\Domain\Space\Operation\Create\Model\SpaceInterface;

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
