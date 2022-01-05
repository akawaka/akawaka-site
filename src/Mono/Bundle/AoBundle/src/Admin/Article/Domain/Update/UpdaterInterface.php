<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Article\Domain\Update;

use Mono\Bundle\AoBundle\Admin\Article\Domain\Update\DataPersister\Model\ArticleInterface;

interface UpdaterInterface
{
    public function update(ArticleInterface $article): void;
}
