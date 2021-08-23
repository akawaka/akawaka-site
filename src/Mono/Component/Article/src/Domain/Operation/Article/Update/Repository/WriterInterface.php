<?php

declare(strict_types=1);

namespace Mono\Component\Article\Domain\Operation\Article\Update\Repository;

use Mono\Component\Article\Domain\Operation\Article\Update\Model\ArticleInterface;

interface WriterInterface
{
    public function update(ArticleInterface $article): bool;
}
