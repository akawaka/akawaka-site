<?php

declare(strict_types=1);

namespace App\Context\Admin\Author\Domain\Create\DataPersister;

use App\Context\Admin\Author\Domain\Create\DataPersister\Model\AuthorInterface;

interface CreatePersisterInterface
{
    public function create(AuthorInterface $author): bool;
}
