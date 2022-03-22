<?php

declare(strict_types=1);

namespace App\Context\Admin\Article\Domain\Create;

use App\Context\Admin\Article\Domain\Create\DataPersister\Model\ArticleInterface;

interface CreatorInterface
{
    public function create(ArticleInterface $article): void;
}
