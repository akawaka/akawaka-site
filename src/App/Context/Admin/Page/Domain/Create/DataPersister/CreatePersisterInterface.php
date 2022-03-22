<?php

declare(strict_types=1);

namespace App\Context\Admin\Page\Domain\Create\DataPersister;

use App\Context\Admin\Page\Domain\Create\DataPersister\Model\PageInterface;

interface CreatePersisterInterface
{
    public function create(PageInterface $page): bool;
}
