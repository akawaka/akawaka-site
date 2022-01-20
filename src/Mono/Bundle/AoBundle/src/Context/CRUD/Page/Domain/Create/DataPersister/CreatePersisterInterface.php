<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Context\CRUD\Page\Domain\Create\DataPersister;

use Mono\Bundle\AoBundle\Context\CRUD\Page\Domain\Create\DataPersister\Model\PageInterface;

interface CreatePersisterInterface
{
    public function create(PageInterface $page): bool;
}
