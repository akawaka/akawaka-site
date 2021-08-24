<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Domain\Operation\Page\Create\Model;

use Mono\Bundle\AoBundle\Admin\Domain\Shared\Identifier\PageId;
use Mono\Bundle\AoBundle\Admin\Domain\Shared\ValueObject\Slug;

interface PageInterface
{
    public function getId(): PageId;

    public function getSlug(): Slug;

    public function getName(): string;

    public function getCreationDate(): \Safe\DateTimeImmutable;
}
