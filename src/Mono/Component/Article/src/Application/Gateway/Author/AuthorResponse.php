<?php

declare(strict_types=1);

namespace Mono\Component\Article\Application\Gateway\Author;

use Mono\Component\Article\Domain\Operation\Author\View\Model\AuthorInterface;

trait AuthorResponse
{
    public function __construct(
        private AuthorInterface $author
    ) {
    }

    public function getAuthor(): AuthorInterface
    {
        return $this->author;
    }

    public function data(): array
    {
        $author = $this->getAuthor();

        return [
            'identifier' => $author->getId()->getValue(),
            'name' => $author->getName(),
            'slug' => $author->getSlug()->getValue(),
        ];
    }
}
