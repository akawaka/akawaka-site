<?php

declare(strict_types=1);

namespace Mono\Component\Channel\Application\Operation\Read\FindByHostname;

final class Query
{
    public function __construct(
        private string $hostname
    ) {
    }

    public function getHostname(): string
    {
        return $this->hostname;
    }
}
