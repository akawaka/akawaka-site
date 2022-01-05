<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Author\Domain\Create\DataPersister;

use Mono\Bundle\AoBundle\Admin\Author\Domain\Create\DataPersister\Model\AuthorInterface;

interface CreatePersisterInterface
{
    public function create(AuthorInterface $author): bool;
}
