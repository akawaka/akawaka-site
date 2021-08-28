<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Page\Domain\View;

use Mono\Bundle\AoBundle\Shared\Domain\Identifier\PageId;
use Mono\Bundle\AoBundle\Shared\Domain\ValueObject\Slug;
use Mono\Bundle\AoBundle\Admin\Page\Domain\View\Exception\UnknownPageException;
use Mono\Bundle\AoBundle\Admin\Page\Domain\View\Factory\BuilderInterface;
use Mono\Bundle\AoBundle\Admin\Page\Domain\View\Model\PageInterface;
use Mono\Bundle\AoBundle\Admin\Page\Domain\View\Repository\ReaderInterface;

final class Viewer implements ViewerInterface
{
    public function __construct(
        private ReaderInterface $reader,
        private BuilderInterface $builder,
    ) {
    }

    public function read(PageId $id): PageInterface
    {
        $result = $this->reader->get($id);

        if ([] === $result) {
            throw new UnknownPageException($id->getValue());
        }

        return $this->builder::build($result);
    }

    public function readBySlug(Slug $slug): ?PageInterface
    {
        $result = $this->reader->getBySlug($slug);

        if ([] === $result) {
            throw new UnknownPageException($slug->getValue());
        }

        return $this->builder::build($result);
    }

    public function readAll(): array
    {
        $collection = [];
        $results = $this->reader->getAll();

        foreach ($results as $result) {
            $collection[] = $this->builder::build($result);
        }

        return $collection;
    }
}
