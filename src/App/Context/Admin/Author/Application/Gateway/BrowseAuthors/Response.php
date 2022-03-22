<?php

declare(strict_types=1);

namespace App\Context\Admin\Author\Application\Gateway\BrowseAuthors;

use Doctrine\Common\Collections\ArrayCollection;
use App\Context\Admin\Author\Domain\Browse\DataProvider\Model\AuthorInterface;
use Mono\Bundle\CoreBundle\Application\Gateway\GatewayResponse;

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
