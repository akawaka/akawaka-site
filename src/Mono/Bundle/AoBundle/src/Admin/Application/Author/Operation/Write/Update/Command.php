<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Application\Author\Operation\Write\Update;

use Mono\Bundle\CoreBundle\Infrastructure\Slugger\Slugger;
use Mono\Bundle\AoBundle\Admin\Domain\Shared\Identifier\AuthorId;
use Mono\Bundle\AoBundle\Admin\Domain\Shared\ValueObject\Slug;

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
