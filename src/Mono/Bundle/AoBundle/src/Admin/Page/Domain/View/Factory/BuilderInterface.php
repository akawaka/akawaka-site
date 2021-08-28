<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Page\Domain\View\Factory;

use Mono\Bundle\AoBundle\Admin\Page\Domain\View\Model\PageInterface;

interface BuilderInterface
{
    public static function build(array $page = []): PageInterface;
}
