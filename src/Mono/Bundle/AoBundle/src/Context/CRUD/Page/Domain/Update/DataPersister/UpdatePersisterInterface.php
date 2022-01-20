<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Context\CRUD\Page\Domain\Update\DataPersister;

use Mono\Bundle\AoBundle\Context\CRUD\Page\Domain\Update\DataPersister\Model\PageInterface;

interface UpdatePersisterInterface
{
    public function update(PageInterface $page): bool;
}
