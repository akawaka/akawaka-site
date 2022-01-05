<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Article\Domain\Update\DataPersister\Factory;

use Mono\Bundle\AoBundle\Admin\Article\Domain\Update\DataPersister\Model\ArticleInterface;

interface BuilderInterface
{
    public static function build(array $article = []): ArticleInterface;
}
