<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Author\Domain\Create;

use Mono\Bundle\AoBundle\Admin\Author\Domain\Create\DataPersister\Model\AuthorInterface;

interface CreatorInterface
{
    public function create(AuthorInterface $author): void;
}
