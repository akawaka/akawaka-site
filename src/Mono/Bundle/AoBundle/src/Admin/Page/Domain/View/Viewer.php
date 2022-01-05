<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Page\Domain\View;

use Mono\Bundle\AoBundle\Admin\Page\Domain\View\DataProvider\Factory\BuilderInterface;
use Mono\Bundle\AoBundle\Admin\Page\Domain\View\DataProvider\Model\PageInterface;
use Mono\Bundle\AoBundle\Admin\Page\Domain\View\DataProvider\ViewProviderInterface;
use Mono\Bundle\AoBundle\Admin\Page\Domain\View\Exception\UnknownPageException;
use Mono\Bundle\AoBundle\Shared\Domain\Identifier\PageId;
use Mono\Bundle\AoBundle\Shared\Domain\ValueObject\Slug;

final class Viewer implements ViewerInterface
{
    public function __construct(
        private ViewProviderInterface $provider,
        private BuilderInterface $builder,
    ) {
    }

    public function read(PageId $id): PageInterface
    {
        $result = $this->provider->get($id);

        if ([] === $result) {
            throw new UnknownPageException($id->getValue());
        }

        return $this->builder::build($result);
    }

    public function readBySlug(Slug $slug): ?PageInterface
    {
        $result = $this->provider->getBySlug($slug);

        if ([] === $result) {
            throw new UnknownPageException($slug->getValue());
        }

        return $this->builder::build($result);
    }

    public function readAll(): array
    {
        $collection = [];
        $results = $this->provider->getAll();

        foreach ($results as $result) {
            $collection[] = $this->builder::build($result);
        }

        return $collection;
    }
}
