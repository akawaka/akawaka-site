<?php

declare(strict_types=1);

namespace App\Context\Admin\Author\Domain\Create;

use App\Context\Admin\Author\Domain\Create\DataPersister\Model\AuthorInterface;

interface CreatorInterface
{
    public function create(AuthorInterface $author): void;
}
