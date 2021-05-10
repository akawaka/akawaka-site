<?php

declare(strict_types=1);

namespace Mono\Component\Page\Domain\Entity;

use Mono\Component\Page\Domain\Identifier\PageId;
use Mono\Component\Page\Domain\ValueObject\PageSlug;

interface PageInterface
{
    public function getId(): PageId;

    public function getName(): string;

    public function getSlug(): PageSlug;

    public function getContent(): ?string;

    public function getStatus(): string;

    public function getCreationDate(): \Safe\DateTimeImmutable;

    public function getLastUpdate(): ?\Safe\DateTimeImmutable;
}
