<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Infrastructure\Theme;

use Mono\Bundle\AoBundle\CMS\Domain\Entity\Channel;
use Mono\Bundle\AoBundle\Infrastructure\Channel\Context\ChannelContextInterface;
use Sylius\Bundle\ThemeBundle\Context\ThemeContextInterface;
use Sylius\Bundle\ThemeBundle\Model\ThemeInterface;
use Sylius\Bundle\ThemeBundle\Repository\ThemeRepositoryInterface;

final class ThemeContext implements ThemeContextInterface
{
    public function __construct(
        private ChannelContextInterface $channelContext,
        private ThemeRepositoryInterface $repository
    ) {
    }

    public function getTheme(): ?ThemeInterface
    {
        /** @var Channel $channel */
        $channel = $this->channelContext->getChannel();

        if (null === $channel->getTheme()) {
            return null;
        }

        return $this->repository->findOneByName($channel->getTheme());
    }
}
