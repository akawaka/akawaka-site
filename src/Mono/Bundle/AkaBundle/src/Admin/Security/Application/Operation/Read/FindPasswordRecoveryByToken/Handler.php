<?php

declare(strict_types=1);

namespace Mono\Bundle\AkaBundle\Admin\Security\Application\Operation\Read\FindPasswordRecoveryByToken;

use Doctrine\ORM\NoResultException;
use Mono\Bundle\AkaBundle\Shared\Domain\Entity\PasswordRecoveryInterface;
use Mono\Bundle\AkaBundle\Shared\Domain\Exception\PasswordRecoveryNotFoundException;
use Mono\Bundle\AkaBundle\Shared\Domain\Repository\FindRecoverPasswordByToken;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

final class Handler implements MessageHandlerInterface
{
    public function __construct(
        private FindRecoverPasswordByToken $reader
    ) {
    }

    public function __invoke(Query $query): PasswordRecoveryInterface
    {
        try {
            $recovery = $this->reader->find($query->getToken());
        } catch (NoResultException $exception) {
            throw new PasswordRecoveryNotFoundException($query->getToken());
        }

        return $recovery;
    }
}
