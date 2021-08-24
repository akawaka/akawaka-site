<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Domain\Operation\Page\Delete;

use Mono\Bundle\AoBundle\Admin\Domain\Shared\Identifier\PageId;

interface DeleterInterface
{
    public function delete(PageId $id): void;
}
