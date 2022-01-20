<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Context\CRUD\Page\Domain\Create;

use Mono\Bundle\AoBundle\Context\CRUD\Page\Domain\Create\DataPersister\Model\PageInterface;

interface CreatorInterface
{
    public function create(PageInterface $page): void;
}
