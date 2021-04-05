<?php

declare(strict_types=1);

namespace App\Cms\Application\Operation\Write\CreatePage;

use Black\Component\Page\Domain\Entity\PageInterface;

final class PageWasCreated
{
    private PageInterface $page;

    public function __construct(PageInterface $page)
    {
        $this->page = $page;
    }

    public function getPage(): PageInterface
    {
        return $this->page;
    }
}
