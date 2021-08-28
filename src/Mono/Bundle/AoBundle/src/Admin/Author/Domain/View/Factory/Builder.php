<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Author\Domain\View\Factory;

use Mono\Bundle\AoBundle\Shared\Domain\Identifier\AuthorId;
use Mono\Bundle\AoBundle\Shared\Domain\ValueObject\Slug;
use Mono\Bundle\AoBundle\Admin\Author\Domain\View\Model\Author;
use Mono\Bundle\AoBundle\Admin\Author\Domain\View\Model\AuthorInterface;

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
