<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Domain\Operation\Page\View\Factory;

use Mono\Bundle\AoBundle\Admin\Domain\Operation\Page\View\Model\PageInterface;

interface BuilderInterface
{
    public static function build(array $page = []): PageInterface;
}
