<?php

declare(strict_types=1);

namespace App\Context\Admin\Author\Application\Operation\Write\Create;

use App\Shared\Domain\Identifier\AuthorId;
use App\Shared\Domain\ValueObject\Slug;
use Mono\Bundle\CoreBundle\Infrastructure\Slugger\Slugger;

final class Command
{
    public function __construct(
        private AuthorId $id,
        private string $name,
        private ?string $slug,
    ) {
    }

    public function getId(): AuthorId
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getSlug(): Slug
    {
        $slug = $this->slug;

        if (null === $slug) {
            $slug = $this->getName();
        }

        return new Slug(Slugger::slugify($slug));
    }
}
