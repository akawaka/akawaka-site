<?php

declare(strict_types=1);

namespace Mono\Component\Article\Domain\Operation\Article\Create\Repository;

use Mono\Component\Article\Domain\Operation\Article\Create\Model\ArticleInterface;

interface WriterInterface
{
    public function create(ArticleInterface $article): bool;
}
