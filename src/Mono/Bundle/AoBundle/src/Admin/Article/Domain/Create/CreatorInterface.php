<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Article\Domain\Create;

use Mono\Bundle\AoBundle\Admin\Article\Domain\Create\Model\ArticleInterface;

interface CreatorInterface
{
    public function create(ArticleInterface $article): void;
}
