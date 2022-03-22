<?php

declare(strict_types=1);

namespace App\Context\Admin\Author\Application\Gateway;

use App\Context\Admin\Author\Domain\View\DataProvider\Model\AuthorInterface;

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
