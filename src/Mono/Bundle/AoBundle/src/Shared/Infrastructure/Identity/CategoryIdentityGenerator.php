<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Shared\Infrastructure\Identity;

use Mono\Bundle\AoBundle\Shared\Domain\Identifier\CategoryId;
use Mono\Bundle\CoreBundle\Infrastructure\Generator\GeneratorInterface;

final class CategoryIdentityGenerator
{
    public function __construct(
        private GeneratorInterface $generator,
    ) {
    }

    public function nextIdentity(): CategoryId
    {
        return new CategoryId($this->generator::generate());
    }
}
