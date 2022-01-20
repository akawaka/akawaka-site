<?php

declare(strict_types=1);

namespace Mono\Bundle\AkaBundle\Context\Security\PasswordRecovery\Domain\View;

use Mono\Bundle\AkaBundle\Context\Security\PasswordRecovery\Domain\View\DataProvider\Factory\BuilderInterface;
use Mono\Bundle\AkaBundle\Context\Security\PasswordRecovery\Domain\View\DataProvider\Model\RecoveryInterface;
use Mono\Bundle\AkaBundle\Context\Security\PasswordRecovery\Domain\View\DataProvider\ViewProviderInterface;
use Mono\Bundle\AkaBundle\Context\Security\PasswordRecovery\Domain\View\Exception\UnknownRecoveryException;
use Mono\Bundle\AkaBundle\Shared\Domain\Identifier\PasswordRecoveryId;

final class Viewer implements ViewerInterface
{
    public function __construct(
        private ViewProviderInterface $provider,
        private BuilderInterface $builder,
    ) {
    }

    public function findById(PasswordRecoveryId $id): RecoveryInterface
    {
        $result = $this->provider->getById($id);

        if ([] === $result) {
            throw new UnknownRecoveryException($id);
        }

        return $this->builder::build($result);
    }

    public function findByToken(string $token): RecoveryInterface
    {
        $result = $this->provider->getByToken($token);

        if ([] === $result) {
            throw new UnknownRecoveryException($token);
        }

        return $this->builder::build($result);
    }
}
