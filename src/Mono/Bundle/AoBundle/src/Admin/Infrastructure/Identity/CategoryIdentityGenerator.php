<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Infrastructure\Identity;

use Mono\Bundle\AoBundle\Admin\Domain\Shared\Identifier\CategoryId;
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
