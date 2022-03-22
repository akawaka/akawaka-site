<?php

declare(strict_types=1);

namespace App\Context\Admin\Page\Application\Operation\Write\Update;

use App\Shared\Domain\Identifier\PageId;
use App\Shared\Domain\ValueObject\Slug;
use Mono\Bundle\CoreBundle\Infrastructure\Slugger\Slugger;

final class Command
{
    public function __construct(
        private string $identifier,
        private string $name,
        private string $slug,
        private ?string $content,
        private array $spaces,
    ) {
    }

    public function getId(): PageId
    {
        return new PageId($this->identifier);
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getSlug(): Slug
    {
        return new Slug(Slugger::slugify($this->slug));
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function getSpaces(): array
    {
        return $this->spaces;
    }
}
