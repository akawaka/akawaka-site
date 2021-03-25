<?php

declare(strict_types=1);

namespace Black\Bundle\CoreBundle\Infrastructure\Notifier\Channel;

use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Notifier\Channel\ChannelInterface;
use Symfony\Component\Notifier\Notification\Notification;
use Symfony\Component\Notifier\Recipient\Recipient;

final class BrowserChannel implements ChannelInterface
{
    private $stack;

    public function __construct(RequestStack $stack)
    {
        $this->stack = $stack;
    }

    public function notify(Notification $notification, Recipient $recipient, string $transportName = null): void
    {
        if (null === $request = $this->stack->getCurrentRequest()) {
            return;
        }

        $message = $notification->getSubject();
        if ($notification->getEmoji()) {
            $message = $notification->getEmoji().' '.$message;
        }

        $request->getSession()->getFlashBag()->add($notification->getImportance(), $message);
    }

    public function supports(Notification $notification, Recipient $recipient): bool
    {
        return true;
    }
}
