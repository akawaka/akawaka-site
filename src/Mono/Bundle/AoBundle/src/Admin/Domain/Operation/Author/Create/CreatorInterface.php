<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Domain\Operation\Author\Create;

use Mono\Bundle\AoBundle\Admin\Domain\Operation\Author\Create\Model\AuthorInterface;

interface CreatorInterface
{
    public function create(AuthorInterface $author): void;
}
