<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Context\CRUD\Article\Domain\Update\DataPersister;

use Mono\Bundle\AoBundle\Context\CRUD\Article\Domain\Update\DataPersister\Model\ArticleInterface;

interface UpdatePersisterInterface
{
    public function update(ArticleInterface $article): bool;
}
