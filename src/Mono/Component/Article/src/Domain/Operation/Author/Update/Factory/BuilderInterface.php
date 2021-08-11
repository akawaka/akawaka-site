<?php

declare(strict_types=1);

namespace Mono\Component\Article\Domain\Operation\Author\Update\Factory;

use Mono\Component\Article\Domain\Operation\Author\Update\Model\AuthorInterface;

interface BuilderInterface
{
    public static function build(array $author = []): AuthorInterface;
}
