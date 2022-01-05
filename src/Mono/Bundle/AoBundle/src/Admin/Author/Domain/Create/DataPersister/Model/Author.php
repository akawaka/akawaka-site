<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Author\Domain\Create\DataPersister\Model;

use Mono\Bundle\AoBundle\Shared\Domain\Identifier\AuthorId;
use Mono\Bundle\AoBundle\Shared\Domain\ValueObject\Slug;

final class Author implements AuthorInterface
{
    private \Safe\DateTimeImmutable $creationDate;

    public function __construct(
        private AuthorId $id,
        private Slug $slug,
        private string $name,
    ) {
        $this->creationDate = new \Safe\DateTimeImmutable();
    }

    public function getId(): AuthorId
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

    public function getCreationDate(): \Safe\DateTimeImmutable
    {
        return $this->creationDate;
    }
}
