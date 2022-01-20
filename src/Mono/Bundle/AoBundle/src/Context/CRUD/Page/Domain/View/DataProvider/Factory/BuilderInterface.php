<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Context\CRUD\Page\Domain\View\DataProvider\Factory;

use Mono\Bundle\AoBundle\Context\CRUD\Page\Domain\View\DataProvider\Model\PageInterface;

interface BuilderInterface
{
    public static function build(array $page = []): PageInterface;
}
