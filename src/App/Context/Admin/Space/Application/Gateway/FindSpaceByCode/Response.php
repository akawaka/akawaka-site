<?php

declare(strict_types=1);

namespace App\Context\Admin\Space\Application\Gateway\FindSpaceByCode;

use App\Context\Admin\Space\Domain\View\DataProvider\Model\SpaceInterface;
use Mono\Bundle\CoreBundle\Application\Gateway\GatewayResponse;

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
            'url' => $space->getUrl(),
            'description' => $space->getDescription(),
            'status' => $space->getStatus(),
            'theme' => $space->getTheme(),
            'creationDate' => $space->getCreationDate()->format('Y-m-d H:i:s'),
            'lastUpdate' => null !== $space->getLastUpdate() ? $space->getLastUpdate()->format('Y-m-d H:i:s') : null,
        ];
    }
}
