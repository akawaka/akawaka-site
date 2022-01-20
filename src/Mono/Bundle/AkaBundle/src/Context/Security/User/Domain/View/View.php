<?php

declare(strict_types=1);

namespace Mono\Bundle\AkaBundle\Context\Security\User\Domain\View;

use Mono\Bundle\AkaBundle\Context\Security\User\Domain\View\DataProvider\ViewProviderInterface;
use Symfony\Component\Security\Core\User\UserInterface;

final class View implements ViewInterface
{
    public function __construct(
        private ViewProviderInterface $provider,
    ) {
    }

    public function __invoke(string $usernameOrEmail): UserInterface
    {
        return $this->provider->view($usernameOrEmail);
    }
}
