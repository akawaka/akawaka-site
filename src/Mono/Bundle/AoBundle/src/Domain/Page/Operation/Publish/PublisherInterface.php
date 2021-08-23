<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Domain\Page\Operation\Publish;

use Mono\Component\Page\Domain\Common\Identifier\PageId;

interface PublisherInterface
{
    public function publish(PageId $id): void;
}
