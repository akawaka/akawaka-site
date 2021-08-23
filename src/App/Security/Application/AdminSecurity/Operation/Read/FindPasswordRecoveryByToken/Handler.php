<?php

declare(strict_types=1);

namespace App\Security\Application\AdminSecurity\Operation\Read\FindPasswordRecoveryByToken;

use Doctrine\ORM\NoResultException;
use Mono\Component\AdminSecurity\Domain\Entity\PasswordRecoveryInterface;
use Mono\Component\AdminSecurity\Domain\Exception\PasswordRecoveryNotFoundException;
use Mono\Component\AdminSecurity\Domain\Repository\FindRecoverPasswordByToken;
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
