<?php

declare(strict_types=1);

namespace App\Infrastructure\Theme;

use App\CMS\Domain\Entity\Space;
use App\Infrastructure\Space\Context\SpaceContextInterface;
use Sylius\Bundle\ThemeBundle\Context\ThemeContextInterface;
use Sylius\Bundle\ThemeBundle\Model\ThemeInterface;
use Sylius\Bundle\ThemeBundle\Repository\ThemeRepositoryInterface;

final class ThemeContext implements ThemeContextInterface
{
    public function __construct(
        private SpaceContextInterface $spaceContext,
        private ThemeRepositoryInterface $repository
    ) {
    }

    public function getTheme(): ?ThemeInterface
    {
        /** @var Space $space */
        $space = $this->spaceContext->getSpace();

        if (null === $space->getTheme()) {
            return null;
        }

        return $this->repository->findOneByName($space->getTheme());
    }
}
