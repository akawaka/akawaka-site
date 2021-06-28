<?php

declare(strict_types=1);

namespace Mono\Component\Page\Application\Gateway\CreatePage;

use Mono\Component\Core\Application\Gateway\GatewayResponse;
use Mono\Component\Page\Domain\Common\Identifier\PageId;

final class Response implements GatewayResponse
{
    public function __construct(
        private PageId $id,
        private bool $success
    ) {
    }

    public function getId(): PageId
    {
        return $this->id;
    }

    public function getSuccess(): bool
    {
        return $this->success;
    }

    public function data(): array
    {
        return [
            'identifier' => $this->getId()->getValue(),
            'success' => $this->getSuccess(),
        ];
    }
}
