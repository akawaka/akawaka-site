<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Infrastructure\Twig;

use Mono\Bundle\AoBundle\Infrastructure\Channel\Context\ChannelContextInterface;
use Twig\Extension\AbstractExtension;
use Twig\Extension\GlobalsInterface;

final class AoExtension extends AbstractExtension implements GlobalsInterface
{
    public function __construct(
        private ChannelContextInterface $channelContext,
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
        return $this->channelContext->getChannel();
    }
}
