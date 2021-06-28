<?php

declare(strict_types=1);

namespace Mono\Component\Page\Domain\Operation\View\Model;

use Mono\Component\Page\Domain\Common\Identifier\PageId;
use Mono\Component\Page\Domain\Common\ValueObject\PageSlug;

final class Page implements PageInterface
{
    public function __construct(
        private PageId $id,
        private PageSlug $slug,
        private string $name,
        private \DateTimeImmutable $creationDate,
        private ?\DateTimeImmutable $lastUpdate,
        private ?string $content = null,
    ) {
    }

    public function getId(): PageId
    {
        return $this->id;
    }

    public function getSlug(): PageSlug
    {
        return $this->slug;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function getCreationDate(): \Safe\DateTimeImmutable
    {
        return \Safe\DateTimeImmutable::createFromRegular($this->creationDate);
    }

    public function getLastUpdate(): ?\Safe\DateTimeImmutable
    {
        if (null === $this->lastUpdate) {
            return null;
        }

        return \Safe\DateTimeImmutable::createFromRegular($this->lastUpdate);
    }
}
