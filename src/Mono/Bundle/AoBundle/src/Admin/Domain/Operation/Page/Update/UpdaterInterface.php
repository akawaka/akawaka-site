<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Domain\Operation\Page\Update;

use Mono\Bundle\AoBundle\Admin\Domain\Operation\Page\Update\Model\PageInterface;

interface UpdaterInterface
{
    public function update(PageInterface $page): void;
}
