<?php

declare(strict_types=1);

namespace Mono\Component\Page\Domain\Operation\View\Factory;

use Mono\Component\Page\Domain\Common\Identifier\PageId;
use Mono\Component\Page\Domain\Common\ValueObject\PageSlug;
use Mono\Component\Page\Domain\Operation\View\Model\Page;
use Mono\Component\Page\Domain\Operation\View\Model\PageInterface;

final class Builder implements BuilderInterface
{
    public static function build(array $page = []): PageInterface
    {
        return new Page(
            new PageId($page['id']),
            new PageSlug($page['slug']),
            $page['name'],
            $page['status'],
            \DateTimeImmutable::createFromFormat('Y-m-d', $page['creation_date']),
            null !== $page['last_update'] ? \DateTimeImmutable::createFromFormat('Y-m-d', $page['last_update']) : null,
            $page['content'],
        );
    }
}
