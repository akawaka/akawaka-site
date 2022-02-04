<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Context\CRUD\Page\Domain\Browse\DataProvider\Factory;

use Mono\Bundle\AoBundle\Context\CRUD\Page\Domain\Browse\DataProvider\Model\PageInterface;

interface BuilderInterface
{
    public static function build(array $page = []): PageInterface;
}
