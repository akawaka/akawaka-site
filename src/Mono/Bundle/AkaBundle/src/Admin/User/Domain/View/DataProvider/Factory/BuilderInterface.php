<?php

declare(strict_types=1);

namespace Mono\Bundle\AkaBundle\Admin\User\Domain\View\DataProvider\Factory;

use Mono\Bundle\AkaBundle\Admin\User\Domain\View\DataProvider\Model\UserInterface;

interface BuilderInterface
{
    public static function build(\Mono\Bundle\AkaBundle\Shared\Domain\Model\UserInterface $user): UserInterface;
}
