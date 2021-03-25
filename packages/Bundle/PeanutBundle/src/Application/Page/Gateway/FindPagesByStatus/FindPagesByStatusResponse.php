<?php

declare(strict_types=1);

namespace Black\Bundle\PeanutBundle\Application\Page\Gateway\FindPagesByStatus;

use Black\Bundle\CoreBundle\Application\GatewayResponse;
use Black\Bundle\PeanutBundle\Application\Page\Gateway\FindPagesByStatus\Response\PageResponse;
use Doctrine\Common\Collections\ArrayCollection;

final class FindPagesByStatusResponse implements GatewayResponse
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
