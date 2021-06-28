<?php

declare(strict_types=1);

namespace App\CMS\Domain\Page\Operation\Publish;

use Mono\Component\Page\Domain\Common\Identifier\PageId;

interface PublisherInterface
{
    public function publish(PageId $id): void;
}
