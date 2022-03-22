<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Identity;

use App\Shared\Domain\Identifier\PageId;
use Mono\Bundle\CoreBundle\Infrastructure\Generator\GeneratorInterface;

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
