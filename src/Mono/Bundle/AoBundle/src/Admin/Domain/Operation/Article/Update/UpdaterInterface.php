<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Domain\Operation\Article\Update;

use Mono\Bundle\AoBundle\Admin\Domain\Operation\Article\Update\Model\ArticleInterface;

interface UpdaterInterface
{
    public function update(ArticleInterface $article): void;
}
