<?php

declare(strict_types=1);

namespace Mono\Component\Page\Infrastructure\Identity;

use Mono\Component\Core\Infrastructure\Generator\GeneratorInterface;
use Mono\Component\Page\Domain\Common\Identifier\PageId;

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
