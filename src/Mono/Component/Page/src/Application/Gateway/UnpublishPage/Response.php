<?php

declare(strict_types=1);

namespace Mono\Component\Page\Application\Gateway\UnpublishPage;

use Mono\Component\Core\Application\Gateway\GatewayResponse;
use Mono\Component\Page\Domain\Entity\PageInterface;

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
        return [];
    }
}
