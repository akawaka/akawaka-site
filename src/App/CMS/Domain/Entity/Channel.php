<?php

declare(strict_types=1);

namespace App\CMS\Domain\Entity;

use Mono\Component\Channel\Domain\Entity\Channel as BaseChannel;
use Mono\Component\Channel\Domain\Entity\ChannelInterface;
use Mono\Component\Channel\Domain\Identifier\ChannelId;
use Mono\Component\Channel\Domain\ValueObject\ChannelCode;

class Channel extends BaseChannel
{
    protected ?string $theme;

    public function __construct()
    {
        parent::__construct();

        $this->theme = null;
    }

    public static function create(
        ChannelId $id,
        ChannelCode $code,
        string $name,
        ?string $theme,
    ): ChannelInterface {
        $channel = new self();
        $channel->id = $id->getValue();
        $channel->code = $code->getValue();
        $channel->name = $name;
        $channel->theme = $theme;

        return $channel;
    }

    public function updateTheme(
        ?string $theme
    ): void {
        $this->theme = $theme;
    }

    public function getTheme(): ?string
    {
        return $this->theme;
    }
}
