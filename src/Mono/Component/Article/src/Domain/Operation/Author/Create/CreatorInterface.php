<?php

declare(strict_types=1);

namespace Mono\Component\Article\Domain\Operation\Author\Create;

use Mono\Component\Article\Domain\Operation\Author\Create\Model\AuthorInterface;

interface CreatorInterface
{
    public function create(AuthorInterface $author): void;
}
