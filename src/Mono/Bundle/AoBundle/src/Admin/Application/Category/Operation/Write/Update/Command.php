<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Application\Category\Operation\Write\Update;

use Mono\Bundle\CoreBundle\Infrastructure\Slugger\Slugger;
use Mono\Bundle\AoBundle\Admin\Domain\Shared\Identifier\CategoryId;
use Mono\Bundle\AoBundle\Admin\Domain\Shared\ValueObject\Slug;

final class Command
{
    public function __construct(
        private string $identifier,
        private string $name,
        private string $slug,
    ) {
    }

    public function getId(): CategoryId
    {
        return new CategoryId($this->identifier);
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
