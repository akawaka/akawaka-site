<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Author\Domain\Update\DataPersister;

use Mono\Bundle\AoBundle\Admin\Author\Domain\Update\DataPersister\Model\AuthorInterface;

interface UpdatePersisterInterface
{
    public function update(AuthorInterface $author): bool;
}
