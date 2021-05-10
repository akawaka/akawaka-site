<?php

declare(strict_types=1);

namespace Mono\Component\Channel\Domain\Exception;

final class ChannelNotFoundException extends \Exception
{
    public function __construct(string $identifier)
    {
        parent::__construct(
            \Safe\sprintf('Channel with identifier or code %s is unknown', $identifier)
        );
    }
}
