<?php

declare(strict_types=1);

namespace Mono\Bundle\AkaBundle\Context\Security\User\Domain\View\DataProvider;

use Symfony\Component\Security\Core\User\UserInterface;

interface ViewProviderInterface
{
    public function view(string $usernameOrEmail): UserInterface;
}
