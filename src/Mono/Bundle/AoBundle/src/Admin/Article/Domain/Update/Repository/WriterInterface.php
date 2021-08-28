<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Article\Domain\Update\Repository;

use Mono\Bundle\AoBundle\Admin\Article\Domain\Update\Model\ArticleInterface;

interface WriterInterface
{
    public function update(ArticleInterface $article): bool;
}
