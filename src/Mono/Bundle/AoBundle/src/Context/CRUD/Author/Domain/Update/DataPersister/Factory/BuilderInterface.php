<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Context\CRUD\Author\Domain\Update\DataPersister\Factory;

use Mono\Bundle\AoBundle\Context\CRUD\Author\Domain\Update\DataPersister\Model\AuthorInterface;

interface BuilderInterface
{
    public static function build(array $author = []): AuthorInterface;
}
