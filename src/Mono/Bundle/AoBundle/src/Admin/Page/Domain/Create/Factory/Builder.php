<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Page\Domain\Create\Factory;

use Mono\Bundle\AoBundle\Admin\Page\Domain\Create\Model\Page;
use Mono\Bundle\AoBundle\Admin\Page\Domain\Create\Model\PageInterface;

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
