<?php

declare(strict_types=1);

namespace App\Context\Admin\Page\Domain\Publish;

use App\Shared\Domain\Identifier\PageId;

interface PublisherInterface
{
    public function publish(PageId $id): void;
}
