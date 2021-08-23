<?php

declare(strict_types=1);

namespace Mono\Component\Article\Domain\Operation\Author\Update\Repository;

use Mono\Component\Article\Domain\Operation\Author\Update\Model\AuthorInterface;

interface WriterInterface
{
    public function update(AuthorInterface $author): bool;
}
