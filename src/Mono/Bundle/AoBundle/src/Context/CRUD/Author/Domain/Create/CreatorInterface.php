<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Context\CRUD\Author\Domain\Create;

use Mono\Bundle\AoBundle\Context\CRUD\Author\Domain\Create\DataPersister\Model\AuthorInterface;

interface CreatorInterface
{
    public function create(AuthorInterface $author): void;
}
