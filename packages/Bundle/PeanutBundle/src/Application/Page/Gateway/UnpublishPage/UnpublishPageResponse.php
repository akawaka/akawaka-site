<?php

declare(strict_types=1);

namespace Black\Bundle\PeanutBundle\Application\Page\Gateway\UnpublishPage;

use Black\Bundle\CoreBundle\Application\GatewayResponse;
use Black\Bundle\PeanutBundle\Domain\Identifier\PageId;

final class UnpublishPageResponse implements GatewayResponse
{
    private PageId $id;

    public function __construct(
        PageId $id
    ) {
        $this->id = $id;
    }

    public function data(): array
    {
        return [
            'id' => $this->getId()->getValue(),
        ];
    }

    public function getId(): PageId
    {
        return $this->id;
    }
}
