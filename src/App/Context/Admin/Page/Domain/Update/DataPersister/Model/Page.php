<?php

declare(strict_types=1);

namespace App\Context\Admin\Page\Domain\Update\DataPersister\Model;

use App\Shared\Domain\Identifier\PageId;
use App\Shared\Domain\ValueObject\Slug;

final class Page implements PageInterface
{
    public function __construct(
        private PageId $id,
        private Slug $slug,
        private string $name,
        private ?string $content,
        private array $spaces = [],
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

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function getSpaces(): array
    {
        return $this->spaces;
    }
}
