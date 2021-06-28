<?php

declare(strict_types=1);

namespace App\CMS\Domain\Page\Operation\View\Factory;

use App\CMS\Domain\Page\Operation\View\Model\Page;
use Doctrine\Common\Collections\ArrayCollection;
use Mono\Component\Page\Domain\Common\Identifier\PageId;
use Mono\Component\Page\Domain\Common\ValueObject\PageSlug;
use Mono\Component\Page\Domain\Operation\View\Factory\BuilderInterface;
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
            new ArrayCollection($page['spaces']),
            \DateTimeImmutable::createFromFormat('Y-m-d', $page['creation_date']),
            null !== $page['last_update'] ? \DateTimeImmutable::createFromFormat('Y-m-d', $page['last_update']) : null,
            $page['content'],
        );
    }
}
