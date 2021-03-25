<?php

declare(strict_types=1);

namespace Black\Bundle\PeanutBundle\Application\Page\Query;

final class QueryFindPageBySlug
{
    private string $slug;

    public function __construct(
        string $slug
    ) {
        $this->slug = $slug;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }
}
