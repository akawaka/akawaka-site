<?php

declare(strict_types=1);

namespace Mono\Component\Article\Application\Gateway\Author\FindAuthors;

use Doctrine\Common\Collections\ArrayCollection;
use Mono\Component\Core\Application\Gateway\GatewayResponse;
use Mono\Component\Article\Domain\Operation\Author\View\Model\AuthorInterface;

final class Response implements GatewayResponse
{
    private ArrayCollection $authors;

    public function __construct()
    {
        $this->authors = new ArrayCollection();
    }

    public function add(AuthorInterface $author): void
    {
        $this->authors->add($author);
    }

    public function getAuthors(): ArrayCollection
    {
        return $this->authors;
    }

    public function data(): array
    {
        return $this->getAuthors()->map(function (AuthorInterface $author) {
            return [
                'identifier' => $author->getId()->getValue(),
                'name' => $author->getName(),
                'slug' => $author->getSlug()->getValue(),
            ];
        })->toArray();
    }
}
