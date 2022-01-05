<?php

declare(strict_types=1);

namespace Mono\Bundle\AkaBundle\Security\PasswordRecovery\Application\Operation\Read\FindById;

use Mono\Bundle\AkaBundle\Security\PasswordRecovery\Domain\View\DataProvider\Model\RecoveryInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Mono\Bundle\AkaBundle\Security\PasswordRecovery\Domain\View\ViewerInterface;

final class Handler implements MessageHandlerInterface
{
    public function __construct(
        private ViewerInterface $viewer
    ) {
    }

    public function __invoke(Query $query): RecoveryInterface
    {
        return $this->viewer->findById($query->getId());
    }
}
