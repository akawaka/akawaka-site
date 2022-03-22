<?php

declare(strict_types=1);

namespace App\Context\Admin\Page\Domain\Update;

use App\Context\Admin\Page\Domain\Update\DataPersister\Model\PageInterface;

interface UpdaterInterface
{
    public function update(PageInterface $page): void;
}
