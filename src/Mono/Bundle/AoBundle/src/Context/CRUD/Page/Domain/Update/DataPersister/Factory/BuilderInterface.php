<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Context\CRUD\Page\Domain\Update\DataPersister\Factory;

use Mono\Bundle\AoBundle\Context\CRUD\Page\Domain\Update\DataPersister\Model\PageInterface;

interface BuilderInterface
{
    public static function build(array $page = []): PageInterface;
}
