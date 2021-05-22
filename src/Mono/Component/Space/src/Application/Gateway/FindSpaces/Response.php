<?php

declare(strict_types=1);

namespace Mono\Component\Space\Application\Gateway\FindSpaces;

use Doctrine\Common\Collections\ArrayCollection;
use Mono\Component\Space\Domain\Entity\SpaceInterface;
use Mono\Component\Core\Application\Gateway\GatewayResponse;

final class Response implements GatewayResponse
{
    private ArrayCollection $spaces;

    public function __construct()
    {
        $this->spaces = new ArrayCollection();
    }

    public function addSpace(SpaceInterface $space): void
    {
        $this->spaces->add($space);
    }

    public function getSpaces(): ArrayCollection
    {
        return $this->spaces;
    }

    public function data(): array
    {
        return $this->getSpaces()->map(function (SpaceInterface $space) {
            return [
                'identifier' => $space->getId()->getValue(),
                'code' => $space->getCode()->getValue(),
                'name' => $space->getName(),
                'url' => $space->getUrl(),
                'description' => $space->getDescription(),
                'status' => $space->getStatus(),
                'creationDate' => $space->getCreationDate()->format('Y-m-d H:i:s'),
                'lastUpdate' => null !== $space->getLastUpdate() ? $space->getLastUpdate()->format('Y-m-d H:i:s') : null,
            ];
        })->toArray();
    }
}
