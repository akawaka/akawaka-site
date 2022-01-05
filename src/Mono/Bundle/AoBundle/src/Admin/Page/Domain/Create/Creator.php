<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Page\Domain\Create;

use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Mono\Bundle\AoBundle\Admin\Page\Domain\Create\DataPersister\Model\PageInterface;
use Mono\Bundle\AoBundle\Admin\Page\Domain\Create\DataPersister\CreatePersisterInterface;
use Mono\Bundle\AoBundle\Admin\Page\Domain\Create\Exception\AlreadyExistingPageException;
use Mono\Bundle\AoBundle\Admin\Page\Domain\Create\Exception\UnableToCreateException;

final class Creator implements CreatorInterface
{
    public function __construct(
        private CreatePersisterInterface $persister
    ) {
    }

    public function create(PageInterface $page): void
    {
        try {
            $this->persister->create($page);
        } catch (UniqueConstraintViolationException $exception) {
            throw new AlreadyExistingPageException($page->getId());
        } catch (\Exception $exception) {
            throw new UnableToCreateException($exception->getMessage());
        }
    }
}
