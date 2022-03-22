<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Identity;

use App\Shared\Domain\Identifier\ArticleId;
use Mono\Bundle\CoreBundle\Infrastructure\Generator\GeneratorInterface;

final class ArticleIdentityGenerator
{
    public function __construct(
        private GeneratorInterface $generator,
    ) {
    }

    public function nextIdentity(): ArticleId
    {
        return new ArticleId($this->generator::generate());
    }
}
