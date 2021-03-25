<?php

declare(strict_types=1);

namespace Black\Bundle\PeanutBundle\Application\Page\Command;

use Black\Bundle\PeanutBundle\Domain\Identifier\PageId;

final class CommandCreatePage
{
    private PageId $id;

    private string $name;

    private ?string $slug;

    private string $content;

    public function __construct(
        PageId $id,
        string $name,
        ?string $slug,
        string $content
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->slug = $slug;
        $this->content = $content;
    }

    public function getId(): PageId
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getSlug(): ?string
    {
        if (null === $this->slug) {
            return $this->name;
        }

        return $this->slug;
    }

    public function getContent(): string
    {
        return $this->content;
    }
}
