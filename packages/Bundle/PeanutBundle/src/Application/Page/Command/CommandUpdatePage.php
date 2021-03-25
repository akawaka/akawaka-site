<?php

declare(strict_types=1);

namespace Black\Bundle\PeanutBundle\Application\Page\Command;

final class CommandUpdatePage
{
    private string $id;

    private string $name;

    private string $slug;

    private string $content;

    public function __construct(
        string $id,
        string $name,
        string $slug,
        string $content
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->slug = $slug;
        $this->content = $content;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getSlug(): string
    {
        return $this->slug;
    }

    public function getContent(): string
    {
        return $this->content;
    }
}
