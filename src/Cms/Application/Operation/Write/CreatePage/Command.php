<?php

declare(strict_types=1);

namespace App\Cms\Application\Operation\Write\CreatePage;

use Black\Component\Channel\Domain\Entity\ChannelInterface;
use Black\Component\Page\Domain\ValueObject\PageSlug;

final class Command
{
    private string $name;

    private ?string $slug;

    private ChannelInterface $channel;

    public function __construct(
        string $name,
        ?string $slug,
        ChannelInterface $channel,
    ) {
        $this->name = $name;
        $this->slug = $slug;
        $this->channel = $channel;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getSlug(): PageSlug
    {
        $slug = $this->slug;

        if (null === $slug) {
            $slug = $this->getName();
        }

        return new PageSlug($slug);
    }

    public function getChannel(): ChannelInterface
    {
        return $this->channel;
    }
}
