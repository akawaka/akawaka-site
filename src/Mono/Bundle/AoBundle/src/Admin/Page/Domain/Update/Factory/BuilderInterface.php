<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Page\Domain\Update\Factory;

use Mono\Bundle\AoBundle\Admin\Page\Domain\Update\Model\PageInterface;

interface BuilderInterface
{
    public static function build(array $page = []): PageInterface;
}
