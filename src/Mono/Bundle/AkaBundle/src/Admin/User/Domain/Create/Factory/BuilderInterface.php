<?php

declare(strict_types=1);

namespace Mono\Bundle\AkaBundle\Admin\User\Domain\Create\Factory;

use Mono\Bundle\AkaBundle\Admin\User\Domain\Create\Model\UserInterface;

interface BuilderInterface
{
    public static function build(array $user = []): UserInterface;
}
