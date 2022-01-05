<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Page\Domain\Create\DataPersister\Factory;

use Mono\Bundle\AoBundle\Admin\Page\Domain\Create\DataPersister\Model\PageInterface;

interface BuilderInterface
{
    public static function build(array $page = []): PageInterface;
}
