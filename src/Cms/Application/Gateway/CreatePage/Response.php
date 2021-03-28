<?php

declare(strict_types=1);

namespace App\Cms\Application\Gateway\CreatePage;

use Black\Component\Page\Domain\Entity\Page;
use Black\Component\Core\Application\Gateway\GatewayResponse;

final class Response implements GatewayResponse
{
    public Page $page;

    public function __construct(Page $page)
    {
        $this->page = $page;
    }

    public function getPage(): Page
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
            'status' => $page->getStatus(),
            'creationDate' => $page->getCreationDate()->format('Y-m-d H:i:s'),
            'lastUpdate' => null !== $page->getLastUpdate() ? $page->getLastUpdate()->format('Y-m-d H:i:s') : null,
        ];
    }
}
