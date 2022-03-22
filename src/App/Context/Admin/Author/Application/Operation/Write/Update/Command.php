<?php

declare(strict_types=1);

namespace App\Context\Admin\Author\Application\Operation\Write\Update;

use App\Shared\Domain\Identifier\AuthorId;
use App\Shared\Domain\ValueObject\Slug;
use Mono\Bundle\CoreBundle\Infrastructure\Slugger\Slugger;

final class Command
{
    public function __construct(
        private string $identifier,
        private string $name,
        private string $slug,
    ) {
    }

    public function getId(): AuthorId
    {
        return new AuthorId($this->identifier);
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getSlug(): Slug
    {
        return new Slug(Slugger::slugify($this->slug));
    }
}
