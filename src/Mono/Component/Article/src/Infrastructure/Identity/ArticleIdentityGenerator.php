<?php

declare(strict_types=1);

namespace Mono\Component\Article\Infrastructure\Identity;

use Mono\Component\Article\Domain\Common\Identifier\ArticleId;
use Mono\Component\Core\Infrastructure\Generator\GeneratorInterface;

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
