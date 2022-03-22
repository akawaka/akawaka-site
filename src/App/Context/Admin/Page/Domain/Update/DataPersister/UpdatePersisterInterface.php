<?php

declare(strict_types=1);

namespace App\Context\Admin\Page\Domain\Update\DataPersister;

use App\Context\Admin\Page\Domain\Update\DataPersister\Model\PageInterface;

interface UpdatePersisterInterface
{
    public function update(PageInterface $page): bool;
}
