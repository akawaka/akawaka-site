<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Page\Application\Gateway\FindPageBySlug;

use Mono\Bundle\CoreBundle\Application\Gateway\GatewayResponse;
use Mono\Bundle\AoBundle\Admin\Page\Domain\View\Model\PageInterface;

final class Response implements GatewayResponse
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
            'status' => $page->getStatus(),
            'creationDate' => $page->getCreationDate()->format('Y-m-d H:i:s'),
            'lastUpdate' => null !== $page->getLastUpdate() ? $page->getLastUpdate()->format('Y-m-d H:i:s') : null,
        ];
    }
}
