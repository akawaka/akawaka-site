<?php

declare(strict_types=1);

namespace Mono\Bundle\AkaBundle\Admin\User\Application\Operation\Write\Create;

use App\Security\Domain\Entity\User;
use Mono\Bundle\CoreBundle\Infrastructure\Notifier\BrowserNotificationInterface;
use Mono\Bundle\CoreBundle\Infrastructure\Notifier\BrowserContext;
use Symfony\Component\Security\Core\User\UserInterface;

final class AdminWasRegistered implements BrowserNotificationInterface
{
    public function __construct(
        private User $admin,
    ) {
    }

    public function getAdmin(): UserInterface
    {
        return $this->admin;
    }

    public function asBrowserNotification(): BrowserContext
    {
        return new BrowserContext('admin_security.registered', 'success');
    }
}
