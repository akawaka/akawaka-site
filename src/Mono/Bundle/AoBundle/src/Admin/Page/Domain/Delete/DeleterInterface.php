<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Page\Domain\Delete;

use Mono\Bundle\AoBundle\Shared\Domain\Identifier\PageId;

interface DeleterInterface
{
    public function delete(PageId $id): void;
}
