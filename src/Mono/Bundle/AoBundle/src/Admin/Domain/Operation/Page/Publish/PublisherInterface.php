<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Domain\Operation\Page\Publish;

use Mono\Bundle\AoBundle\Admin\Domain\Shared\Identifier\PageId;

interface PublisherInterface
{
    public function publish(PageId $id): void;
}
