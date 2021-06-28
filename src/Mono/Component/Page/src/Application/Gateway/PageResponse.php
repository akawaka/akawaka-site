<?php

declare(strict_types=1);

namespace Mono\Component\Page\Application\Gateway;

use Mono\Component\Page\Domain\Operation\View\Model\PageInterface;

trait PageResponse
{
    public function __construct(
        private PageInterface $page
    ) {
    }

    public function getPage(): PageInterface
    {
        return $this->page;
    }

    public function data(): array
    {
        $page = $this->getPage();

        return [
            'identifier' => $page->getId()->getValue(),
            'name' => $page->getName(),
            'slug' => $page->getSlug()->getValue(),
            'content' => $page->getContent(),
            'creationDate' => $page->getCreationDate()->format('Y-m-d H:i:s'),
            'lastUpdate' => null !== $page->getLastUpdate() ? $page->getLastUpdate()->format('Y-m-d H:i:s') : null,
        ];
    }
}