<?php

declare(strict_types=1);

namespace App\Context\Admin\Article\Domain\Update;

use App\Context\Admin\Article\Domain\Update\DataPersister\Model\ArticleInterface;

interface UpdaterInterface
{
    public function update(ArticleInterface $article): void;
}
