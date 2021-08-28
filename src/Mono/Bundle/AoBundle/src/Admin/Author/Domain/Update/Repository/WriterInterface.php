<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Author\Domain\Update\Repository;

use Mono\Bundle\AoBundle\Admin\Author\Domain\Update\Model\AuthorInterface;

interface WriterInterface
{
    public function update(AuthorInterface $author): bool;
}
