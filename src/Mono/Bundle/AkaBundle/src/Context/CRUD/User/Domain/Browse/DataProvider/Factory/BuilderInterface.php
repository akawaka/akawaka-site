<?php

declare(strict_types=1);

namespace Mono\Bundle\AkaBundle\Context\CRUD\User\Domain\Browse\DataProvider\Factory;

use Mono\Bundle\AkaBundle\Context\CRUD\User\Domain\Browse\DataProvider\Model\UserInterface;

interface BuilderInterface
{
    public static function build(\Symfony\Component\Security\Core\User\UserInterface $user): UserInterface;
}
