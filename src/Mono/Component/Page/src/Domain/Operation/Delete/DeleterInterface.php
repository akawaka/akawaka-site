<?php

declare(strict_types=1);

namespace Mono\Component\Page\Domain\Operation\Delete;

use Mono\Component\Page\Domain\Common\Identifier\PageId;

interface DeleterInterface
{
    public function delete(PageId $id): void;
}
