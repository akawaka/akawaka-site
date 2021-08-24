<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Domain\Operation\Page\Update\Factory;

use Mono\Bundle\AoBundle\Admin\Domain\Operation\Page\Update\Model\PageInterface;

interface BuilderInterface
{
    public static function build(array $page = []): PageInterface;
}
