<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Context\CRUD\Page\Application\Gateway\FindPages;

use Doctrine\Common\Collections\ArrayCollection;
use Mono\Bundle\AoBundle\Context\CRUD\Page\Domain\View\DataProvider\Model\PageInterface;
use Mono\Bundle\CoreBundle\Application\Gateway\GatewayResponse;

final class Response implements GatewayResponse
{
    private ArrayCollection $pages;

    public function __construct()
    {
        $this->pages = new ArrayCollection();
    }

    public function add(PageInterface $page): void
    {
        $this->pages->add($page);
    }

    public function getPages(): ArrayCollection
    {
        return $this->pages;
    }

    public function data(): array
    {
        return $this->getPages()->map(function (PageInterface $page) {
            return [
                'identifier' => $page->getId()->getValue(),
                'name' => $page->getName(),
                'slug' => $page->getSlug()->getValue(),
                'content' => $page->getContent(),
                'status' => $page->getStatus(),
                'creationDate' => $page->getCreationDate()->format('Y-m-d H:i:s'),
                'lastUpdate' => null !== $page->getLastUpdate() ? $page->getLastUpdate()->format('Y-m-d H:i:s') : null,
            ];
        })->toArray();
    }
}
