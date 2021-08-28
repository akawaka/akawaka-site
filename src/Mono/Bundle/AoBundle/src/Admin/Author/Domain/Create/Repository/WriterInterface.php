<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Author\Domain\Create\Repository;

use Mono\Bundle\AoBundle\Admin\Author\Domain\Create\Model\AuthorInterface;

interface WriterInterface
{
    public function create(AuthorInterface $author): bool;
}
