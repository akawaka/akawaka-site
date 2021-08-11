<?php

declare(strict_types=1);

namespace Mono\Component\Article\Domain\Operation\Author\Create\Repository;

use Mono\Component\Article\Domain\Operation\Author\Create\Model\AuthorInterface;

interface WriterInterface
{
    public function create(AuthorInterface $author): bool;
}
