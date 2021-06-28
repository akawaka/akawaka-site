<?php

declare(strict_types=1);

namespace Mono\Component\Page\Domain\Operation\View\Model;

use Mono\Component\Page\Domain\Common\Identifier\PageId;
use Mono\Component\Page\Domain\Common\ValueObject\PageSlug;

interface PageInterface
{
    public function getId(): PageId;

    public function getSlug(): PageSlug;

    public function getName(): string;

    public function getContent(): ?string;

    public function getCreationDate(): \Safe\DateTimeImmutable;

    public function getLastUpdate(): ?\Safe\DateTimeImmutable;
}