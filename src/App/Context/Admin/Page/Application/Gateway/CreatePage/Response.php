<?php

declare(strict_types=1);

namespace App\Context\Admin\Page\Application\Gateway\CreatePage;

use App\Shared\Domain\Identifier\PageId;
use Mono\Bundle\CoreBundle\Application\Gateway\GatewayResponse;

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
