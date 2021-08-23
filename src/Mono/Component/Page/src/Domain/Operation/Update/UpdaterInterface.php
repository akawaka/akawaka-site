<?php

declare(strict_types=1);

namespace Mono\Component\Page\Domain\Operation\Update;

use Mono\Component\Page\Domain\Operation\Update\Model\PageInterface;

interface UpdaterInterface
{
    public function update(PageInterface $page): void;
}
