<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Domain\Operation\Author\View\Factory;

use Mono\Bundle\AoBundle\Admin\Domain\Shared\Identifier\AuthorId;
use Mono\Bundle\AoBundle\Admin\Domain\Shared\ValueObject\Slug;
use Mono\Bundle\AoBundle\Admin\Domain\Operation\Author\View\Model\Author;
use Mono\Bundle\AoBundle\Admin\Domain\Operation\Author\View\Model\AuthorInterface;

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
