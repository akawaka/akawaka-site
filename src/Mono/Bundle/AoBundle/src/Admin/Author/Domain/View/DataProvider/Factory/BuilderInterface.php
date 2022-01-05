<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Author\Domain\View\DataProvider\Factory;

use Mono\Bundle\AoBundle\Admin\Author\Domain\View\DataProvider\Model\AuthorInterface;

interface BuilderInterface
{
    public static function build(array $author = []): AuthorInterface;
}
