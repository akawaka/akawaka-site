<?php

declare(strict_types=1);

namespace App\CMS\Application\Gateway\UpdateSpace;

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
        $space = $this->getSpace();

        return [
            'identifier' => $space->getId()->getValue(),
            'code' => $space->getCode()->getValue(),
            'name' => $space->getName(),
            'theme' => $space->getTheme(),
            'url' => $space->getUrl(),
            'description' => $space->getDescription(),
            'status' => $space->getStatus(),
            'creationDate' => $space->getCreationDate()->format('Y-m-d H:i:s'),
            'lastUpdate' => null !== $space->getLastUpdate() ? $space->getLastUpdate()->format('Y-m-d H:i:s') : null,
        ];
    }
}
