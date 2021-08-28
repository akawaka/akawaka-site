<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Page\Domain\Create;

use Mono\Bundle\AoBundle\Admin\Page\Domain\Create\Model\PageInterface;

interface CreatorInterface
{
    public function create(PageInterface $page): void;
}
