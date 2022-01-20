<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Context\CRUD\Author\Domain\Update;

use Mono\Bundle\AoBundle\Context\CRUD\Author\Domain\Update\DataPersister\Model\AuthorInterface;

interface UpdaterInterface
{
    public function update(AuthorInterface $author): void;
}
