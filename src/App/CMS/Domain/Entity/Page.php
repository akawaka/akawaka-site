<?php

declare(strict_types=1);

namespace App\CMS\Domain\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Mono\Component\Page\Domain\Entity\Page as BasePage;
use Mono\Component\Channel\Domain\Entity\ChannelInterface;
use Mono\Component\Page\Domain\Entity\PageInterface;
use Mono\Component\Page\Domain\Identifier\PageId;
use Mono\Component\Page\Domain\ValueObject\PageSlug;

class Page extends BasePage
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
        ArrayCollection $channels,
    ): PageInterface {
        $page = new self();
        $page->id = $id->getValue();
        $page->slug = $slug->getValue();
        $page->name = $name;
        $page->channels = $channels;

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

    public function getChannels(): Collection
    {
        return $this->channels;
    }
}
