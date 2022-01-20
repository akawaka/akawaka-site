<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Context\CRUD\Author\Domain\Create\DataPersister\Factory;

use Mono\Bundle\AoBundle\Context\CRUD\Author\Domain\Create\DataPersister\Model\Author;
use Mono\Bundle\AoBundle\Context\CRUD\Author\Domain\Create\DataPersister\Model\AuthorInterface;

final class Builder implements BuilderInterface
{
    public static function build(array $author = []): AuthorInterface
    {
        return new Author(
            $author['id'],
            $author['slug'],
            $author['name'],
        );
    }
}
