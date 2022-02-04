<?php

declare(strict_types=1);

namespace Mono\Bundle\AkaBundle\Context\CRUD\User\Domain\View\DataProvider;

use Mono\Bundle\AkaBundle\Shared\Domain\Identifier\UserId;
use Mono\Bundle\AkaBundle\Shared\Domain\Model\UserInterface;

interface ViewProviderInterface
{
    public function get(UserId $id): UserInterface;
}
