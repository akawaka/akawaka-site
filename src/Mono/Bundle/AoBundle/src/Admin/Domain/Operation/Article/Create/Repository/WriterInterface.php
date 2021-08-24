<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Domain\Operation\Article\Create\Repository;

use Mono\Bundle\AoBundle\Admin\Domain\Operation\Article\Create\Model\ArticleInterface;

interface WriterInterface
{
    public function create(ArticleInterface $article): bool;
}
