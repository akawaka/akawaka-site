<?php

declare(strict_types=1);

namespace Mono\Component\Page\Domain\Operation\Create\Factory;

use Mono\Component\Page\Domain\Operation\Create\Model\Page;
use Mono\Component\Page\Domain\Operation\Create\Model\PageInterface;

final class Builder implements BuilderInterface
{
    public static function build(array $page = []): PageInterface
    {
        return new Page(
            $page['id'],
            $page['slug'],
            $page['name'],
        );
    }
}
