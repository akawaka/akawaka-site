<?php

declare(strict_types=1);

namespace App\Context\Admin\Author\Domain\Create\DataPersister\Factory;

use App\Context\Admin\Author\Domain\Create\DataPersister\Model\AuthorInterface;

interface BuilderInterface
{
    public static function build(array $author = []): AuthorInterface;
}
