<?php

declare(strict_types=1);

namespace App\Context\Admin\Page\Domain\Browse\DataProvider\Model;

use App\Shared\Domain\Identifier\PageId;
use App\Shared\Domain\ValueObject\Slug;

interface PageInterface
{
    public function getId(): PageId;

    public function getSlug(): Slug;

    public function getName(): string;

    public function getContent(): ?string;

    public function getCreationDate(): \Safe\DateTimeImmutable;

    public function getLastUpdate(): ?\Safe\DateTimeImmutable;
}
