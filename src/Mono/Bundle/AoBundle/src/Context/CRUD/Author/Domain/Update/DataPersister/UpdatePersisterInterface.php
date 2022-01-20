<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Context\CRUD\Author\Domain\Update\DataPersister;

use Mono\Bundle\AoBundle\Context\CRUD\Author\Domain\Update\DataPersister\Model\AuthorInterface;

interface UpdatePersisterInterface
{
    public function update(AuthorInterface $author): bool;
}
