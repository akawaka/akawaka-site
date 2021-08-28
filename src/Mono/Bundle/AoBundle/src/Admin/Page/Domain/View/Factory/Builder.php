<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Page\Domain\View\Factory;

use Mono\Bundle\AoBundle\Admin\Page\Domain\View\Model\Page;
use Doctrine\Common\Collections\ArrayCollection;
use Mono\Bundle\AoBundle\Shared\Domain\Identifier\PageId;
use Mono\Bundle\AoBundle\Shared\Domain\ValueObject\Slug;
use Mono\Bundle\AoBundle\Admin\Page\Domain\View\Model\PageInterface;

final class Builder implements BuilderInterface
{
    public static function build(array $page = []): PageInterface
    {
        return new Page(
            new PageId($page['id']),
            new Slug($page['slug']),
            $page['name'],
            $page['status'],
            new ArrayCollection($page['spaces']),
            \DateTimeImmutable::createFromFormat('Y-m-d H:i:s', $page['creation_date']),
            null !== $page['last_update'] ? \DateTimeImmutable::createFromFormat('Y-m-d H:i:s', $page['last_update']) : null,
            $page['content'],
        );
    }
}
