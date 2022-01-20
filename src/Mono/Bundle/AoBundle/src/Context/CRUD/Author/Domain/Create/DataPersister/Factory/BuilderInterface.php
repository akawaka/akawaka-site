<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Context\CRUD\Author\Domain\Create\DataPersister\Factory;

use Mono\Bundle\AoBundle\Context\CRUD\Author\Domain\Create\DataPersister\Model\AuthorInterface;

interface BuilderInterface
{
    public static function build(array $author = []): AuthorInterface;
}
