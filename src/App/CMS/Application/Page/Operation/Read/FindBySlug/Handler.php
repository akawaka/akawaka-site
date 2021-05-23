<?php

declare(strict_types=1);

namespace App\CMS\Application\Page\Operation\Read\FindBySlug;

use Doctrine\ORM\NoResultException;
use Mono\Component\Page\Domain\Entity\PageInterface;
use Mono\Component\Page\Domain\Exception\PageNotFoundException;
use Mono\Component\Page\Domain\Repository\FindPageBySlug;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

final class Handler implements MessageHandlerInterface
{
    public function __construct(
        private FindPageBySlug $reader
    ) {
    }

    public function __invoke(Query $query): PageInterface
    {
        try {
            $page = $this->reader->find($query->getSlug());
        } catch (NoResultException $exception) {
            throw new PageNotFoundException($query->getSlug()->getValue());
        }

        return $page;
    }
}
