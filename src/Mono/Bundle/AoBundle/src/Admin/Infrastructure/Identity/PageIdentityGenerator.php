<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Infrastructure\Identity;

use Mono\Bundle\CoreBundle\Infrastructure\Generator\GeneratorInterface;
use Mono\Bundle\AoBundle\Admin\Domain\Shared\Identifier\PageId;

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
