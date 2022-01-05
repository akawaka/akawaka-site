<?php

declare(strict_types=1);

namespace Mono\Bundle\AkaBundle\Security\PasswordRecovery\Infrastructure\Persistence\Doctrine\ORM;

use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use Mono\Bundle\AkaBundle\Security\PasswordRecovery\Domain\View\DataProvider\Factory\BuilderInterface;
use Mono\Bundle\AkaBundle\Security\PasswordRecovery\Domain\View\DataProvider\ViewProviderInterface;
use Mono\Bundle\AkaBundle\Security\PasswordRecovery\Domain\View\Exception\UnknownRecoveryException;
use Mono\Bundle\AkaBundle\Shared\Domain\Identifier\PasswordRecoveryId;
use Mono\Bundle\AkaBundle\Security\PasswordRecovery\Domain\View\DataProvider\Model\RecoveryInterface;
use Mono\Bundle\AkaBundle\Shared\Infrastructure\Persistence\Doctrine\ORM\PasswordRecoveryRepository;

final class ViewProvider implements ViewProviderInterface
{
    public function __construct(
        private BuilderInterface $builder,
        private PasswordRecoveryRepository $repository,
    ) {
    }

    public function getById(PasswordRecoveryId $id): ?RecoveryInterface
    {
        try {
            $result = $this->repository->find($id);
        } catch (NoResultException $e) {
            throw new UnknownRecoveryException($id);
        } catch (NonUniqueResultException $e) {
            throw new UnknownRecoveryException($id);
        }

        return $this->builder::build($result);
    }

    public function getByToken(string $token): ?RecoveryInterface
    {
        try {
            $result = $this->repository->findByToken($token);
        } catch (NoResultException $e) {
            throw new UnknownRecoveryException($token);
        } catch (NonUniqueResultException $e) {
            throw new UnknownRecoveryException($token);
        }

        return $this->builder::build($result);
    }
}
