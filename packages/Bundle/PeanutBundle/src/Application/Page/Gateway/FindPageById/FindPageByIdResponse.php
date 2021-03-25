<?php

declare(strict_types=1);

namespace Black\Bundle\PeanutBundle\Application\Page\Gateway\FindPageById;

use Black\Bundle\CoreBundle\Application\GatewayResponse;
use Black\Bundle\PeanutBundle\Domain\Entity\Page\Page;
use Black\Bundle\PeanutBundle\Domain\Identifier\PageId;

final class FindPageByIdResponse implements GatewayResponse
{
    private Page $page;

    public function __construct(Page $page)
    {
        $this->page = $page;
    }

    public function data(): array
    {
        return [
            'id' => $this->getId()->getValue(),
            'name' => $this->getName(),
            'slug' => $this->getSlug(),
            'content' => $this->getContent(),
            'status' => $this->getStatus(),
            'dateCreated' => $this->getDateCreated(),
            'dateUpdated' => $this->getDateUpdated(),
        ];
    }

    public function getId(): PageId
    {
        return $this->page->getId();
    }

    public function getName(): string
    {
        return $this->page->getName();
    }

    public function getSlug(): string
    {
        return $this->page->getSlug();
    }

    public function getContent(): string
    {
        return $this->page->getContent();
    }

    public function getStatus(): string
    {
        return $this->page->getStatus();
    }

    public function getDateCreated(): \DateTimeImmutable
    {
        return $this->page->getDateCreated();
    }

    public function getDateUpdated(): ?\DateTimeImmutable
    {
        return $this->page->getDateUpdated();
    }
}
