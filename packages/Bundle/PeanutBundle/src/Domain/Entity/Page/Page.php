<?php

declare(strict_types=1);

namespace Black\Bundle\PeanutBundle\Domain\Entity\Page;

use Black\Bundle\PeanutBundle\Domain\Identifier\PageId;
use Black\Component\Page\Entity\Page as BasePage;

class Page extends BasePage
{
    protected string $id;

    public static function create(
        PageId $id,
        string $slug,
        string $name,
        string $content
    ): self {
        $page = new self();
        $page->id = $id->getValue();
        $page->name = $name;
        $page->slug = $slug;
        $page->content = $content;

        return $page;
    }

    public function getId(): PageId
    {
        return new PageId($this->id);
    }

    public function update(
        string $name,
        string $slug,
        string $content
    ) {
        $this->name = $name;
        $this->slug = $slug;
        $this->content = $content;
    }
}
