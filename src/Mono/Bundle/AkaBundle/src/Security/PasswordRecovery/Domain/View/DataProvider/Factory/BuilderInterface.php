<?php

declare(strict_types=1);

namespace Mono\Bundle\AkaBundle\Security\PasswordRecovery\Domain\View\DataProvider\Factory;

use Mono\Bundle\AkaBundle\Security\PasswordRecovery\Domain\View\DataProvider\Model\RecoveryInterface;
use Mono\Bundle\AkaBundle\Shared\Domain\Model\PasswordRecoveryInterface;

interface BuilderInterface
{
    public static function build(PasswordRecoveryInterface $recovery): RecoveryInterface;
}
