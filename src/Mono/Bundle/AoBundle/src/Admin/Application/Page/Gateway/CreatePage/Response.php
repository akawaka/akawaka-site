<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Application\Page\Gateway\CreatePage;

use Mono\Bundle\CoreBundle\Application\Gateway\GatewayResponse;
use Mono\Bundle\AoBundle\Admin\Domain\Shared\Identifier\PageId;

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
