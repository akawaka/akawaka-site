<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Page\Domain\Publish;

use Mono\Bundle\AoBundle\Shared\Domain\Identifier\PageId;

interface WriterInterface
{
    public function publish(PageId $id): bool;
}
