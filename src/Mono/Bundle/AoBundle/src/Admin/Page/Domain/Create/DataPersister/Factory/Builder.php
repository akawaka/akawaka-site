<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Page\Domain\Create\DataPersister\Factory;

use Mono\Bundle\AoBundle\Admin\Page\Domain\Create\DataPersister\Model\Page;
use Mono\Bundle\AoBundle\Admin\Page\Domain\Create\DataPersister\Model\PageInterface;

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
