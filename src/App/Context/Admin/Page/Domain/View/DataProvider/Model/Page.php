<?php

declare(strict_types=1);

namespace App\Context\Admin\Page\Domain\View\DataProvider\Model;

use Doctrine\Common\Collections\ArrayCollection;
use App\Shared\Domain\Identifier\PageId;
use App\Shared\Domain\ValueObject\Slug;

final class Page implements PageInterface
{
    public function __construct(
        private PageId $id,
        private Slug $slug,
        private string $name,
        private string $status,
        private ArrayCollection $spaces,
        private \DateTimeImmutable $creationDate,
        private ?\DateTimeImmutable $lastUpdate,
        private ?string $content = null,
    ) {
    }

    public function getId(): PageId
    {
        return $this->id;
    }

    public function getSlug(): Slug
    {
        return $this->slug;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getSpaces(): ArrayCollection
    {
        return $this->spaces;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function getStatus(): string
    {
        return $this->status;
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
