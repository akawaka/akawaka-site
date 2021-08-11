<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Domain\Page\Operation\Create\Model;

use Doctrine\Common\Collections\ArrayCollection;
use Mono\Bundle\AoBundle\Domain\Page\Common\Enum\StatusEnum;
use Mono\Component\Page\Domain\Common\Identifier\PageId;
use Mono\Component\Page\Domain\Common\ValueObject\PageSlug;
use Mono\Component\Page\Domain\Operation\Create\Model\PageInterface;

final class Page implements PageInterface
{
    private string $status;

    private \Safe\DateTimeImmutable $creationDate;

    public function __construct(
        private PageId $id,
        private PageSlug $slug,
        private string $name,
        private ArrayCollection $spaces,
    ) {
        $this->status = StatusEnum::DRAFT;
        $this->creationDate = new \Safe\DateTimeImmutable();
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
