<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Page\Domain\Update;

use Mono\Bundle\AoBundle\Admin\Page\Domain\Update\DataPersister\Model\PageInterface;

interface UpdaterInterface
{
    public function update(PageInterface $page): void;
}
