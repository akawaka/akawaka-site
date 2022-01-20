<?php

declare(strict_types=1);

namespace App\Context\Admin\Space\Application\Gateway\FindSpaceByCode;

use App\Context\Admin\Space\Domain\View\DataProvider\Model\Space;
use Doctrine\Common\Collections\ArrayCollection;
use Mono\Bundle\CoreBundle\Application\Gateway\GatewayResponse;

final class Response implements GatewayResponse
{
    private ArrayCollection $spaces;

    public function __construct()
    {
        $this->spaces = new ArrayCollection();
    }

    public function addSpace(Space $space): void
    {
        $this->spaces->add($space);
    }

    public function getSpaces(): ArrayCollection
    {
        return $this->spaces;
    }

    public function data(): array
    {
        return $this->getSpaces()->map(function (Space $space) {
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
        })->toArray();
    }
}
