<?php

declare(strict_types=1);

namespace App\Context\Admin\Author\Domain\Update\DataPersister\Factory;

use App\Context\Admin\Author\Domain\Update\DataPersister\Model\AuthorInterface;

interface BuilderInterface
{
    public static function build(array $author = []): AuthorInterface;
}
