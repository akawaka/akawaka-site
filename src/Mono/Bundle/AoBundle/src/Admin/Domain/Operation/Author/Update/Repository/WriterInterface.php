<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Domain\Operation\Author\Update\Repository;

use Mono\Bundle\AoBundle\Admin\Domain\Operation\Author\Update\Model\AuthorInterface;

interface WriterInterface
{
    public function update(AuthorInterface $author): bool;
}
