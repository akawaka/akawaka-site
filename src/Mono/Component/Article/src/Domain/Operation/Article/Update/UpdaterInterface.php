<?php

declare(strict_types=1);

namespace Mono\Component\Article\Domain\Operation\Article\Update;

use Mono\Component\Article\Domain\Operation\Article\Update\Model\ArticleInterface;

interface UpdaterInterface
{
    public function update(ArticleInterface $article): void;
}