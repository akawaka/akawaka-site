<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Domain\Operation\Author\Create\Factory;

use Mono\Bundle\AoBundle\Admin\Domain\Operation\Author\Create\Model\Author;
use Mono\Bundle\AoBundle\Admin\Domain\Operation\Author\Create\Model\AuthorInterface;

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
