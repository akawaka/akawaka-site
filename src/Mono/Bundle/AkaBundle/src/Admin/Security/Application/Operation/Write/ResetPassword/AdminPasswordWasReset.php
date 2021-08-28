<?php

declare(strict_types=1);

namespace Mono\Bundle\AkaBundle\Admin\Security\Application\Operation\Write\ResetPassword;

use Mono\Bundle\AkaBundle\Shared\Domain\Entity\PasswordRecoveryInterface;
use Mono\Bundle\CoreBundle\Infrastructure\Notifier\BrowserNotificationInterface;
use Mono\Bundle\CoreBundle\Infrastructure\Notifier\BrowserContext;
use Mono\Bundle\CoreBundle\Infrastructure\Notifier\MailerContext;
use Mono\Bundle\CoreBundle\Infrastructure\Notifier\MailerNotificationInterface;
use Symfony\Component\Mime\Address;

final class AdminPasswordWasReset implements BrowserNotificationInterface, MailerNotificationInterface
{
    public function __construct(
        private PasswordRecoveryInterface $passwordRecovery,
    ) {
    }

    public function getPasswordRecovery(): PasswordRecoveryInterface
    {
        return $this->passwordRecovery;
    }

    public function asBrowserNotification(): BrowserContext
    {
        return new BrowserContext('admin_security.password_recovered', 'success');
    }

    public function asMailerNotification(): MailerContext
    {
        return new MailerContext(
            'admin_security.password_recovered',
            [
                'username' => $this->passwordRecovery->getUser()->getUsername(),
                'token' => $this->passwordRecovery->getToken(),
            ],
            new Address($this->passwordRecovery->getUser()->getEmail()->getValue()),
        );
    }
}
