<?php

declare(strict_types=1);

namespace Mono\Bundle\AkaBundle\Context\Security\PasswordRecovery\Application\Operation\Read\FindById;

use Mono\Bundle\AkaBundle\Shared\Domain\Identifier\PasswordRecoveryId;

final class Query
{
    public function __construct(
        private string $id
    ) {
    }

    public function getId(): PasswordRecoveryId
    {
        return new PasswordRecoveryId($this->id);
    }
}
