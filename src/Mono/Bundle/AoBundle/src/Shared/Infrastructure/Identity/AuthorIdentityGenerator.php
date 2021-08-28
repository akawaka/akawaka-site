<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Shared\Infrastructure\Identity;

use Mono\Bundle\AoBundle\Shared\Domain\Identifier\AuthorId;
use Mono\Bundle\CoreBundle\Infrastructure\Generator\GeneratorInterface;

final class AuthorIdentityGenerator
{
    public function __construct(
        private GeneratorInterface $generator,
    ) {
    }

    public function nextIdentity(): AuthorId
    {
        return new AuthorId($this->generator::generate());
    }
}
