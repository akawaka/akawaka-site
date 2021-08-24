<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Domain\Operation\Page\View\Model;

use Mono\Bundle\AoBundle\Admin\Domain\Shared\Identifier\PageId;
use Mono\Bundle\AoBundle\Admin\Domain\Shared\ValueObject\Slug;

interface PageInterface
{
    public function getId(): PageId;

    public function getSlug(): Slug;

    public function getName(): string;

    public function getContent(): ?string;

    public function getCreationDate(): \Safe\DateTimeImmutable;

    public function getLastUpdate(): ?\Safe\DateTimeImmutable;
}
