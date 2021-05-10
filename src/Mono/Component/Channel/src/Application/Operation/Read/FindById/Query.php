<?php

declare(strict_types=1);

namespace Mono\Component\Channel\Application\Operation\Read\FindById;

use Mono\Component\Channel\Domain\Identifier\ChannelId;

final class Query
{
    private string $id;

    public function __construct(string $id)
    {
        $this->id = $id;
    }

    public function getId(): ChannelId
    {
        return new ChannelId($this->id);
    }
}
