<?php

declare(strict_types=1);

namespace Mono\Component\Page\Application\Operation\Read\FindById;

use Doctrine\ORM\NoResultException;
use Mono\Component\Page\Domain\Entity\PageInterface;
use Mono\Component\Page\Domain\Exception\PageNotFoundException;
use Mono\Component\Page\Domain\Repository\FindPageById;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

final class Handler implements MessageHandlerInterface
{
    public function __construct(
        private FindPageById $reader
    ) {
    }

    public function __invoke(Query $query): PageInterface
    {
        try {
            $page = $this->reader->find($query->getId());
        } catch (NoResultException $exception) {
            throw new PageNotFoundException($query->getId()->getValue());
        }

        return $page;
    }
}
