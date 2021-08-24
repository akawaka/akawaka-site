<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Domain\Operation\Page\Create\Factory;

use Mono\Bundle\AoBundle\Admin\Domain\Operation\Page\Create\Model\PageInterface;

interface BuilderInterface
{
    public static function build(array $page = []): PageInterface;
}
