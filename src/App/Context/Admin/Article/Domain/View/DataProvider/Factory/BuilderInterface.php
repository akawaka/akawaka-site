<?php

declare(strict_types=1);

namespace App\Context\Admin\Article\Domain\View\DataProvider\Factory;

use App\Context\Admin\Article\Domain\View\DataProvider\Model\ArticleInterface;

interface BuilderInterface
{
    public static function build(array $article = []): ArticleInterface;
}
