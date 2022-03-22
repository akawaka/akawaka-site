<?php

declare(strict_types=1);

namespace App\Context\Admin\Article\Domain\Update\DataPersister;

use App\Context\Admin\Article\Domain\Update\DataPersister\Model\ArticleInterface;

interface UpdatePersisterInterface
{
    public function update(ArticleInterface $article): bool;
}
