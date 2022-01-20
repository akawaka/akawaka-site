<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Context\CRUD\Article\Domain\Create;

use Mono\Bundle\AoBundle\Context\CRUD\Article\Domain\Create\DataPersister\Model\ArticleInterface;

interface CreatorInterface
{
    public function create(ArticleInterface $article): void;
}
