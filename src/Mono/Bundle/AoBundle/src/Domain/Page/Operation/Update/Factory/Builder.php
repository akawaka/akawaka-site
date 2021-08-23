<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Domain\Page\Operation\Update\Factory;

use Mono\Bundle\AoBundle\Domain\Page\Operation\Update\Model\Page;
use Mono\Component\Page\Domain\Operation\Update\Factory\BuilderInterface;
use Mono\Component\Page\Domain\Operation\Update\Model\PageInterface;

final class Builder implements BuilderInterface
{
    public static function build(array $page = []): PageInterface
    {
        return new Page(
            $page['id'],
            $page['slug'],
            $page['name'],
            $page['content'],
            $page['spaces'],
        );
    }
}
