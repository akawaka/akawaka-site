<?php

declare(strict_types=1);

namespace App\Context\Admin\Article\Domain\Create\DataPersister\Factory;

use App\Context\Admin\Article\Domain\Create\DataPersister\Model\ArticleInterface;

interface BuilderInterface
{
    public static function build(array $article = []): ArticleInterface;
}
