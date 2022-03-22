<?php

declare(strict_types=1);

namespace App\Context\Admin\Page\Domain\Create;

use App\Context\Admin\Page\Domain\Create\DataPersister\Model\PageInterface;

interface CreatorInterface
{
    public function create(PageInterface $page): void;
}
