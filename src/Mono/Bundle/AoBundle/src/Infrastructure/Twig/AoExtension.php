<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Infrastructure\Twig;

use Symfony\Component\HttpFoundation\RequestStack;
use Twig\Extension\AbstractExtension;
use Twig\Extension\GlobalsInterface;

final class AoExtension extends AbstractExtension implements GlobalsInterface
{
    public function __construct(
        private RequestStack $stack,
    ) {

    }

    public function getGlobals(): array
    {
        return [
            'ao' => $this->getChannel(),
        ];
    }

    public function getChannel()
    {
        return $this->stack->getMasterRequest()->request->get('ao');
    }
}
