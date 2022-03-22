<?php

declare(strict_types=1);

namespace App\Context\Admin\Page\Domain\Create\DataPersister\Model;

use App\Shared\Domain\Identifier\PageId;
use App\Shared\Domain\ValueObject\Slug;

interface PageInterface
{
    public function getId(): PageId;

    public function getSlug(): Slug;

    public function getName(): string;

    public function getCreationDate(): \Safe\DateTimeImmutable;
}
