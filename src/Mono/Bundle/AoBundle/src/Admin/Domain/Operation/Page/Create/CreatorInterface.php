<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Domain\Operation\Page\Create;

use Mono\Bundle\AoBundle\Admin\Domain\Operation\Page\Create\Model\PageInterface;

interface CreatorInterface
{
    public function create(PageInterface $page): void;
}
