<?php

declare(strict_types=1);

namespace App\Context\Admin\Page\Domain\Create\DataPersister\Model;

use Doctrine\Common\Collections\ArrayCollection;
use App\Shared\Domain\Enum\PageStatus;
use App\Shared\Domain\Identifier\PageId;
use App\Shared\Domain\ValueObject\Slug;

final class Page implements PageInterface
{
    private string $status;

    private \Safe\DateTimeImmutable $creationDate;

    public function __construct(
        private PageId $id,
        private Slug $slug,
        private string $name,
        private ArrayCollection $spaces,
    ) {
        $this->status = PageStatus::DRAFT;
        $this->creationDate = new \Safe\DateTimeImmutable();
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

    public function getStatus(): string
    {
        return $this->status;
    }

    public function getSpaces(): ArrayCollection
    {
        return $this->spaces;
    }

    public function getCreationDate(): \Safe\DateTimeImmutable
    {
        return $this->creationDate;
    }
}
