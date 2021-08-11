<?php

declare(strict_types=1);

namespace Mono\Component\Page\Application\Gateway\CreatePage;

use Mono\Component\Core\Application\Gateway\GatewayResponse;
use Mono\Component\Page\Domain\Common\Identifier\PageId;

final class Response implements GatewayResponse
{
    public function __construct(
        private PageId $id,
    ) {
    }

    public function getId(): PageId
    {
        return $this->id;
    }

    public function data(): array
    {
        return [
            'identifier' => $this->getId()->getValue(),
        ];
    }
}
