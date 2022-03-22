<?php

declare(strict_types=1);

namespace App\Context\Admin\Author\Domain\Update\DataPersister\Factory;

use App\Context\Admin\Author\Domain\Update\DataPersister\Model\Author;
use App\Context\Admin\Author\Domain\Update\DataPersister\Model\AuthorInterface;

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
