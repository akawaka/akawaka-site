<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Article\Domain\Create\Repository;

use Mono\Bundle\AoBundle\Admin\Article\Domain\Create\Model\ArticleInterface;

interface WriterInterface
{
    public function create(ArticleInterface $article): bool;
}
