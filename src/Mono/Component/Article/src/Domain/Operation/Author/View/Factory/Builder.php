<?php

declare(strict_types=1);

namespace Mono\Component\Article\Domain\Operation\Author\View\Factory;

use Mono\Component\Article\Domain\Common\Identifier\AuthorId;
use Mono\Component\Article\Domain\Common\ValueObject\Slug;
use Mono\Component\Article\Domain\Operation\Author\View\Model\Author;
use Mono\Component\Article\Domain\Operation\Author\View\Model\AuthorInterface;

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
