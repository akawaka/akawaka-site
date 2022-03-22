<?php

declare(strict_types=1);

namespace App\Context\Admin\Article\Domain\Create\DataPersister;

use App\Context\Admin\Article\Domain\Create\DataPersister\Model\ArticleInterface;

interface CreatePersisterInterface
{
    public function create(ArticleInterface $article): bool;
}
