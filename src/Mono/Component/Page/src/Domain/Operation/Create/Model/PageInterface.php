<?php

declare(strict_types=1);

namespace Mono\Component\Page\Domain\Operation\Create\Model;

use Mono\Component\Page\Domain\Common\Identifier\PageId;
use Mono\Component\Page\Domain\Common\ValueObject\PageSlug;

interface PageInterface
{
    public function getId(): PageId;

    public function getSlug(): PageSlug;

    public function getName(): string;

    public function getCreationDate(): \Safe\DateTimeImmutable;
}
