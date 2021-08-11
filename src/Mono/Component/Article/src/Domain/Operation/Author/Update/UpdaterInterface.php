<?php

declare(strict_types=1);

namespace Mono\Component\Article\Domain\Operation\Author\Update;

use Mono\Component\Article\Domain\Operation\Author\Update\Model\AuthorInterface;

interface UpdaterInterface
{
    public function update(AuthorInterface $author): void;
}
