<?php

declare(strict_types=1);

namespace App\Context\Admin\Author\Domain\Update;

use App\Context\Admin\Author\Domain\Update\DataPersister\Model\AuthorInterface;

interface UpdaterInterface
{
    public function update(AuthorInterface $author): void;
}
