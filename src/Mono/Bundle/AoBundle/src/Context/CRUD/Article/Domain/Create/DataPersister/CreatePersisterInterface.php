<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Context\CRUD\Article\Domain\Create\DataPersister;

use Mono\Bundle\AoBundle\Context\CRUD\Article\Domain\Create\DataPersister\Model\ArticleInterface;

interface CreatePersisterInterface
{
    public function create(ArticleInterface $article): bool;
}
