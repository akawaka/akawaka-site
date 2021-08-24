<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Domain\Operation\Author\Create\Repository;

use Mono\Bundle\AoBundle\Admin\Domain\Operation\Author\Create\Model\AuthorInterface;

interface WriterInterface
{
    public function create(AuthorInterface $author): bool;
}
