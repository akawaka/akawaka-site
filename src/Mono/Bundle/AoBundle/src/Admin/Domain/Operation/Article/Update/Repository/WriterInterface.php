<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Domain\Operation\Article\Update\Repository;

use Mono\Bundle\AoBundle\Admin\Domain\Operation\Article\Update\Model\ArticleInterface;

interface WriterInterface
{
    public function update(ArticleInterface $article): bool;
}
