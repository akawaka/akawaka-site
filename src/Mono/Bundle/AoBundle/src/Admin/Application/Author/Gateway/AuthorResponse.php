<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Application\Author\Gateway;

use Mono\Bundle\AoBundle\Admin\Domain\Operation\Author\View\Model\AuthorInterface;

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
