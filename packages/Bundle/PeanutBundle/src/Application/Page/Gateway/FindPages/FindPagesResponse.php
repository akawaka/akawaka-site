<?php

declare(strict_types=1);

namespace Black\Bundle\PeanutBundle\Application\Page\Gateway\FindPages;

use Black\Bundle\CoreBundle\Application\GatewayResponse;
use Black\Bundle\PeanutBundle\Application\Page\Gateway\FindPages\Response\PageResponse;
use Doctrine\Common\Collections\ArrayCollection;

final class FindPagesResponse implements GatewayResponse
{
    private ArrayCollection $pages;

    public function __construct()
    {
        $this->pages = new ArrayCollection();
    }

    public function data(): array
    {
        return [
            'pages' => $this->getPages()->toArray(),
            'count' => $this->getPages()->count(),
        ];
    }

    public function getPages(): ArrayCollection
    {
        return $this->pages;
    }

    public function add(PageResponse $page): void
    {
        $this->pages->add($page);
    }
}
