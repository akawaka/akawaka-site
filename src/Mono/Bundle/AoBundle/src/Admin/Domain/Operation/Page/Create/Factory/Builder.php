<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Domain\Operation\Page\Create\Factory;

use Mono\Bundle\AoBundle\Admin\Domain\Operation\Page\Create\Model\Page;
use Mono\Bundle\AoBundle\Admin\Domain\Operation\Page\Create\Factory\BuilderInterface;
use Mono\Bundle\AoBundle\Admin\Domain\Operation\Page\Create\Model\PageInterface;

final class Builder implements BuilderInterface
{
    public static function build(array $page = []): PageInterface
    {
        return new Page(
            $page['id'],
            $page['slug'],
            $page['name'],
            $page['spaces'],
        );
    }
}
