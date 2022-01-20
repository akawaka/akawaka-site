<?php

declare(strict_types=1);

namespace App\Infrastructure\Theme;

use App\Infrastructure\Theme\Space\Context\SpaceContextInterface;
use App\Context\Admin\Space\Domain\View\DataProvider\Model\Space;
use Sylius\Bundle\ThemeBundle\Context\SettableThemeContext;
use Sylius\Bundle\ThemeBundle\Context\ThemeContextInterface;
use Sylius\Bundle\ThemeBundle\Repository\ThemeRepositoryInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\HttpKernelInterface;

final class ThemeListener implements EventSubscriberInterface
{
    public function __construct(
        private SpaceContextInterface $spaceContext,
        private SettableThemeContext $themeContext,
        private ThemeRepositoryInterface $repository,
    ) {
    }

    public static function getSubscribedEvents(): array
    {
        return [
            RequestEvent::class => ['onKernelRequest'],
        ];
    }

    public function onKernelRequest(RequestEvent $event): void
    {
        if (HttpKernelInterface::MAIN_REQUEST !== $event->getRequestType()) {
            return;
        }

        try {
            /** @var Space $space */
            $space = $this->spaceContext->getSpace();

            if (null === $space->getTheme()) {
                return;
            }

            $this->themeContext->setTheme(
                $this->repository->findOneByName($space->getTheme())
            );
        } catch (\Exception $exception) {
            return;
        }
    }
}
