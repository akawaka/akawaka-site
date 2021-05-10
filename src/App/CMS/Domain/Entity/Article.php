<?php

declare(strict_types=1);

namespace App\CMS\Domain\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Mono\Component\Article\Domain\Entity\Article as BaseArticle;
use Mono\Component\Article\Domain\Entity\ArticleInterface;
use Mono\Component\Article\Domain\Identifier\ArticleId;
use Mono\Component\Article\Domain\ValueObject\Slug;
use Mono\Component\Channel\Domain\Entity\ChannelInterface;

class Article extends BaseArticle
{
    public Collection $channels;

    public function __construct()
    {
        $this->channels = new ArrayCollection();

        parent::__construct();
    }

    public static function create(
        ArticleId $id,
        Slug $slug,
        string $name,
        ArrayCollection $categories,
        ArrayCollection $channels,
    ): ArticleInterface {
        $article = new self();
        $article->id = $id->getValue();
        $article->slug = $slug->getValue();
        $article->name = $name;
        $article->categories = $categories;
        $article->channels = $channels;

        return $article;
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
