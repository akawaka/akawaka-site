<?php

declare(strict_types=1);

namespace Mono\Component\Page\Domain\Operation\Create\Factory;

use Mono\Component\Page\Domain\Operation\Create\Model\PageInterface;

interface BuilderInterface
{
    public static function build(array $page = []): PageInterface;
}
