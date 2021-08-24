<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Application\Space\Gateway\CreateSpace;

use Mono\Bundle\AoBundle\Admin\Domain\Shared\Identifier\SpaceId;
use Mono\Bundle\CoreBundle\Application\Gateway\GatewayResponse;
use Mono\Bundle\AoBundle\Admin\Domain\Operation\Space\Create\Model\SpaceInterface;

final class Response implements GatewayResponse
{
    public function __construct(
        private SpaceId $id,
    ) {
    }

    public function getId(): SpaceId
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
