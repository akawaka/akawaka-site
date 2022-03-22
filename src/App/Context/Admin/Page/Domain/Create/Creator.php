<?php

declare(strict_types=1);

namespace App\Context\Admin\Page\Domain\Create;

use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use App\Context\Admin\Page\Domain\Create\DataPersister\CreatePersisterInterface;
use App\Context\Admin\Page\Domain\Create\DataPersister\Model\PageInterface;
use App\Context\Admin\Page\Domain\Create\Exception\AlreadyExistingPageException;
use App\Context\Admin\Page\Domain\Create\Exception\UnableToCreateException;

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
