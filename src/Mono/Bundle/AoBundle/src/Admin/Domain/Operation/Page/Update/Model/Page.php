<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Domain\Operation\Page\Update\Model;

use Mono\Bundle\AoBundle\Admin\Domain\Shared\Identifier\PageId;
use Mono\Bundle\AoBundle\Admin\Domain\Shared\ValueObject\Slug;
use Mono\Bundle\AoBundle\Admin\Domain\Operation\Page\Update\Model\PageInterface;

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
