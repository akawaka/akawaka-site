<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Domain\Operation\Article\Create;

use Mono\Bundle\AoBundle\Admin\Domain\Operation\Article\Create\Model\ArticleInterface;

interface CreatorInterface
{
    public function create(ArticleInterface $article): void;
}
