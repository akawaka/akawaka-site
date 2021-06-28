<?php

declare(strict_types=1);

namespace App\CMS\Application\Page\Operation\Write\Create;

use Mono\Component\Core\Infrastructure\Slugger\Slugger;
use Mono\Component\Page\Domain\Common\Identifier\PageId;
use Mono\Component\Page\Domain\Common\ValueObject\PageSlug;

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

    public function getSlug(): PageSlug
    {
        $slug = $this->slug;

        if (null === $slug) {
            $slug = $this->getName();
        }

        return new PageSlug(Slugger::slugify($slug));
    }

    public function getSpaces(): array
    {
        return $this->spaces;
    }
}
