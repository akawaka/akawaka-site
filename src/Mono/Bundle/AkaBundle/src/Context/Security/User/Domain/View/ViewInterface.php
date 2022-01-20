<?php

declare(strict_types=1);

namespace Mono\Bundle\AkaBundle\Context\Security\User\Domain\View;

use Symfony\Component\Security\Core\User\UserInterface;

interface ViewInterface
{
    public function __invoke(string $usernameOrEmail): UserInterface;
}
