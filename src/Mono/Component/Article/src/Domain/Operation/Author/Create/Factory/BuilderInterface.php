<?php

declare(strict_types=1);

namespace Mono\Component\Article\Domain\Operation\Author\Create\Factory;

use Mono\Component\Article\Domain\Operation\Author\Create\Model\AuthorInterface;

interface BuilderInterface
{
    public static function build(array $author = []): AuthorInterface;
}
