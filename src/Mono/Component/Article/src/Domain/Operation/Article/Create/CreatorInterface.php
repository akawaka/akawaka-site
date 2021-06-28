<?php

declare(strict_types=1);

namespace Mono\Component\Article\Domain\Operation\Article\Create;

use Mono\Component\Article\Domain\Operation\Article\Create\Model\ArticleInterface;

interface CreatorInterface
{
    public function create(ArticleInterface $article): void;
}
