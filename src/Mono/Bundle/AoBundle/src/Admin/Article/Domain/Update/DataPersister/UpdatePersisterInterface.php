<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Article\Domain\Update\DataPersister;

use Mono\Bundle\AoBundle\Admin\Article\Domain\Update\DataPersister\Model\ArticleInterface;

interface UpdatePersisterInterface
{
    public function update(ArticleInterface $article): bool;
}
