<?php

declare(strict_types=1);

namespace Mono\Component\Article\Application\Operation\Category\Write\Create;

use Mono\Component\Article\Domain\Common\Identifier\CategoryId;
use Mono\Component\Core\Infrastructure\Slugger\Slugger;
use Mono\Component\Article\Domain\Common\ValueObject\Slug;

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
