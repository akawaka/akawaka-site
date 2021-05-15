<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\CMS\Application\Operation\Write\CreateChannel;

use Mono\Component\Channel\Domain\ValueObject\ChannelCode;

final class Command
{
    public function __construct(
        private string $code,
        private string $name,
        private ?string $theme,
    ) {
    }

    public function getCode(): ChannelCode
    {
        return new ChannelCode($this->code);
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getTheme(): ?string
    {
        return $this->theme;
    }
}
