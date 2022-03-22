<?php

declare(strict_types=1);

namespace App\Context\Admin\Author\Domain\Browse\DataProvider\Factory;

use App\Context\Admin\Author\Domain\Browse\DataProvider\Model\AuthorInterface;

interface BuilderInterface
{
    public static function build(array $author = []): AuthorInterface;
}
