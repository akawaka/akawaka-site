<?php

declare(strict_types=1);

namespace Black\Bundle\PeanutBundle\Application\Page\Command;

use Black\Bundle\PeanutBundle\Domain\Entity\Page\Page;

final class CommandPublishPage
{
    private Page $page;

    public function __construct(
        Page $page
    ) {
        $this->page = $page;
    }

    public function getPage(): Page
    {
        return $this->page;
    }
}
