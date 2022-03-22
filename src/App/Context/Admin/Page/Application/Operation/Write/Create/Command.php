<?php

declare(strict_types=1);

namespace App\Context\Admin\Page\Application\Operation\Write\Create;

use App\Shared\Domain\Identifier\PageId;
use App\Shared\Domain\ValueObject\Slug;
use Mono\Bundle\CoreBundle\Infrastructure\Slugger\Slugger;

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
