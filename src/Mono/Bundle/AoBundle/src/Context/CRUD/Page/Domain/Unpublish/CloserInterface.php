<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Context\CRUD\Page\Domain\Unpublish;

use Mono\Bundle\AoBundle\Shared\Domain\Identifier\PageId;

interface CloserInterface
{
    public function close(PageId $id): void;
}
