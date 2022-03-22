<?php

declare(strict_types=1);

namespace App\Context\Admin\Author\Domain\View\DataProvider\Factory;

use App\Context\Admin\Author\Domain\View\DataProvider\Model\Author;
use App\Context\Admin\Author\Domain\View\DataProvider\Model\AuthorInterface;
use App\Shared\Domain\Identifier\AuthorId;
use App\Shared\Domain\ValueObject\Slug;

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
