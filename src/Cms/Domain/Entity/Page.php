<?php

declare(strict_types=1);

namespace App\Cms\Domain\Entity;

use Black\Component\Channel\Domain\Entity\ChannelInterface;
use Black\Component\Page\Domain\Entity\Page as BasePage;
use Black\Component\Page\Domain\Entity\PageInterface;
use Black\Component\Page\Domain\Identifier\PageId;
use Black\Component\Page\Domain\ValueObject\PageSlug;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

final class Page extends BasePage
{
    public Collection $channels;

    public function __construct()
    {
        $this->channels = new ArrayCollection();

        parent::__construct();
    }

    public static function create(
        PageId $id,
        PageSlug $slug,
        string $name,
        ChannelInterface $channel,
    ): PageInterface {
        $page = new self();
        $page->id = $id->getValue();
        $page->slug = $slug->getValue();
        $page->name = $name;
        $page->addChannel($channel);

        return $page;
    }

    public function addChannel(ChannelInterface $channel): void
    {
        if (false === $this->containsChannel($channel)) {
            $this->channels->add($channel);
        }
    }

    public function removeChannel(ChannelInterface $channel): void
    {
        if (true === $this->containsChannel($channel)) {
            $this->channels->removeElement($channel);
        }
    }

    public function containsChannel(ChannelInterface $channel): bool
    {
        return $this->channels->contains($channel);
    }
}
