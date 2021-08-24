<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Domain\Operation\Author\Create\Model;

use Mono\Bundle\AoBundle\Admin\Domain\Shared\Identifier\AuthorId;
use Mono\Bundle\AoBundle\Admin\Domain\Shared\ValueObject\Slug;

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
