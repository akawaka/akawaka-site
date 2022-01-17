<?php

declare(strict_types=1);

namespace App\Infrastructure\Twig;

use App\Infrastructure\Theme\Space\Context\SpaceContextInterface;
use Twig\Extension\AbstractExtension;
use Twig\Extension\GlobalsInterface;

final class AoExtension extends AbstractExtension implements GlobalsInterface
{
    public function __construct(
        private SpaceContextInterface $spaceContext,
    ) {
    }

    public function getGlobals(): array
    {
        return [
            'ao' => $this->getSpace(),
        ];
    }

    public function getSpace()
    {
        return $this->spaceContext->getSpace();
    }
}
