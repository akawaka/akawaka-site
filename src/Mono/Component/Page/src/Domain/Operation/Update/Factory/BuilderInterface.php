<?php

declare(strict_types=1);

namespace Mono\Component\Page\Domain\Operation\Update\Factory;

use Mono\Component\Page\Domain\Operation\Update\Model\PageInterface;

interface BuilderInterface
{
    public static function build(array $page = []): PageInterface;
}
