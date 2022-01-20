<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Context\CRUD\Category\Application\Operation\Write\Create;

use Mono\Bundle\AoBundle\Shared\Domain\Identifier\CategoryId;
use Mono\Bundle\AoBundle\Shared\Domain\ValueObject\Slug;
use Mono\Bundle\CoreBundle\Infrastructure\Slugger\Slugger;

final class Command
{
    public function __construct(
        private CategoryId $id,
        private string $name,
        private ?string $slug,
    ) {
    }

    public function getId(): CategoryId
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
