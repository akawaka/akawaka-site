<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Context\CRUD\Author\Domain\Browse\DataProvider\Factory;

use Mono\Bundle\AoBundle\Context\CRUD\Author\Domain\Browse\DataProvider\Model\Author;
use Mono\Bundle\AoBundle\Context\CRUD\Author\Domain\Browse\DataProvider\Model\AuthorInterface;
use Mono\Bundle\AoBundle\Shared\Domain\Identifier\AuthorId;
use Mono\Bundle\AoBundle\Shared\Domain\ValueObject\Slug;

final class Builder implements BuilderInterface
{
    public static function build(array $author = []): AuthorInterface
    {
        return new Author(
            new AuthorId($author['id']),
            new Slug($author['slug']),
            $author['name'],
        );
    }
}
