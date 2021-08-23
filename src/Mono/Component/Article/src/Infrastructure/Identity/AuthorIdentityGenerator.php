<?php

declare(strict_types=1);

namespace Mono\Component\Article\Infrastructure\Identity;

use Mono\Component\Article\Domain\Common\Identifier\AuthorId;
use Mono\Component\Core\Infrastructure\Generator\GeneratorInterface;

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
