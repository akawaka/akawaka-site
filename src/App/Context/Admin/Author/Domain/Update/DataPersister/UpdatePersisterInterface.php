<?php

declare(strict_types=1);

namespace App\Context\Admin\Author\Domain\Update\DataPersister;

use App\Context\Admin\Author\Domain\Update\DataPersister\Model\AuthorInterface;

interface UpdatePersisterInterface
{
    public function update(AuthorInterface $author): bool;
}
