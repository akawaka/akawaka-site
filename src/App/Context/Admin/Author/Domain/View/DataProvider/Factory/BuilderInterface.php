<?php

declare(strict_types=1);

namespace App\Context\Admin\Author\Domain\View\DataProvider\Factory;

use App\Context\Admin\Author\Domain\View\DataProvider\Model\AuthorInterface;

interface BuilderInterface
{
    public static function build(array $author = []): AuthorInterface;
}
