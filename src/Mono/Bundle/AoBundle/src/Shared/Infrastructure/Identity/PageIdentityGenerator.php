<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Shared\Infrastructure\Identity;

use Mono\Bundle\CoreBundle\Infrastructure\Generator\GeneratorInterface;
use Mono\Bundle\AoBundle\Shared\Domain\Identifier\PageId;

final class PageIdentityGenerator
{
    public function __construct(
        private GeneratorInterface $generator,
    ) {
    }

    public function nextIdentity(): PageId
    {
        return new PageId($this->generator::generate());
    }
}
