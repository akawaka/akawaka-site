<?php

declare(strict_types=1);

namespace Mono\Bundle\AkaBundle\Security\User\Infrastructure\Authentication;

use Mono\Bundle\CoreBundle\Application\Gateway\GatewayException;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Mono\Bundle\AkaBundle\Security\User\Application\Gateway\Connect;
use Symfony\Component\Security\Http\Event\LoginSuccessEvent;

final class LoginListener implements EventSubscriberInterface
{
    public function __construct(
        private Connect\Gateway $gateway,
    ) {
    }

    public function onLoginSuccess(LoginSuccessEvent $event): void
    {
        $user = $event->getUser();

        try {
            ($this->gateway)(Connect\Request::fromData(['username' => $user->getUsername()]));
        } catch (GatewayException $exception) {
            throw new AuthenticationException();
        }
    }

    public static function getSubscribedEvents(): array
    {
        return [LoginSuccessEvent::class => 'onLoginSuccess'];
    }
}
