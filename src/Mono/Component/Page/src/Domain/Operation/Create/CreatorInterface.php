<?php

declare(strict_types=1);

namespace Mono\Component\Page\Domain\Operation\Create;

use Mono\Component\Page\Domain\Operation\Create\Model\PageInterface;

interface CreatorInterface
{
    public function create(PageInterface $page): void;
}
