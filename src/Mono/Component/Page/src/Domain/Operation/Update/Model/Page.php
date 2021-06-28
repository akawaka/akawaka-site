<?php

declare(strict_types=1);

namespace Mono\Component\Page\Domain\Operation\Update\Model;

use Mono\Component\Page\Domain\Common\Identifier\PageId;
use Mono\Component\Page\Domain\Common\ValueObject\PageSlug;

final class Page implements PageInterface
{
    public function __construct(
        private PageId $id,
        private PageSlug $slug,
        private string $name,
        private ?string $content
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
}
