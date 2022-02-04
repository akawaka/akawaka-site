<?php

declare(strict_types=1);

namespace Mono\Bundle\AkaBundle\Context\CRUD\User\Application\Operation\Read\Browse;

use Mono\Bundle\AkaBundle\Context\CRUD\User\Domain\Browse\DataProvider\Model\UserListInterface;
use Mono\Bundle\AkaBundle\Context\CRUD\User\Domain\Browse\BrowserInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

final class Handler implements MessageHandlerInterface
{
    public function __construct(
        private BrowserInterface $browser
    ) {
    }

    public function __invoke(Query $query): UserListInterface
    {
        return $this->browser->browse();
    }
}
