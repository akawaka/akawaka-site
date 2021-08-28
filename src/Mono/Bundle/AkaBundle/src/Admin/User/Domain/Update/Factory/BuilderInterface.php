<?php

declare(strict_types=1);

namespace Mono\Bundle\AkaBundle\Admin\User\Domain\Update\Factory;

use Mono\Bundle\AkaBundle\Admin\User\Domain\Update\Model\UserInterface;

interface BuilderInterface
{
    public static function build(array $User = []): UserInterface;
}
