<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Context\CRUD\Article\Domain\Browse\DataProvider\Factory;

use Mono\Bundle\AoBundle\Context\CRUD\Article\Domain\Browse\DataProvider\Model\ArticleInterface;

interface BuilderInterface
{
    public static function build(array $article = []): ArticleInterface;
}
