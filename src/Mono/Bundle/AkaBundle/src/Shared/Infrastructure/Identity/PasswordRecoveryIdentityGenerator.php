<?php

declare(strict_types=1);

namespace Mono\Bundle\AkaBundle\Shared\Infrastructure\Identity;

use Mono\Bundle\AkaBundle\Shared\Domain\Identifier\PasswordRecoveryId;
use Mono\Bundle\CoreBundle\Infrastructure\Generator\GeneratorInterface;

final class PasswordRecoveryIdentityGenerator
{
    public function __construct(
        private GeneratorInterface $generator,
    ) {
    }

    public function nextIdentity(): PasswordRecoveryId
    {
        return new PasswordRecoveryId($this->generator::generate());
    }
}
