<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Application\Page\Operation\Write\Create;

use Mono\Bundle\CoreBundle\Infrastructure\Slugger\Slugger;
use Mono\Bundle\AoBundle\Admin\Domain\Shared\Identifier\PageId;
use Mono\Bundle\AoBundle\Admin\Domain\Shared\ValueObject\Slug;

final class Command
{
    public function __construct(
        private PageId $id,
        private string $name,
        private ?string $slug,
        private array $spaces,
    ) {
    }

    public function getId(): PageId
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

    public function getSpaces(): array
    {
        return $this->spaces;
    }
}
