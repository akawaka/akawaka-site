<?php

declare(strict_types=1);

namespace Mono\Component\Page\Domain\Operation\View;

use Mono\Component\Page\Domain\Common\Identifier\PageId;
use Mono\Component\Page\Domain\Common\ValueObject\PageSlug;
use Mono\Component\Page\Domain\Operation\View\Exception\UnknownPageException;
use Mono\Component\Page\Domain\Operation\View\Factory\BuilderInterface;
use Mono\Component\Page\Domain\Operation\View\Model\PageInterface;
use Mono\Component\Page\Domain\Operation\View\Repository\ReaderInterface;

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

    public function readBySlug(PageSlug $slug): ?PageInterface
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
