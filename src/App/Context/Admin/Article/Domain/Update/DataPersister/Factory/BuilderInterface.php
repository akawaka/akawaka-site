<?php

declare(strict_types=1);

namespace App\Context\Admin\Article\Domain\Update\DataPersister\Factory;

use App\Context\Admin\Article\Domain\Update\DataPersister\Model\ArticleInterface;

interface BuilderInterface
{
    public static function build(array $article = []): ArticleInterface;
}
