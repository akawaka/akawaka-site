<?php

declare(strict_types=1);

namespace App\UI\Front\EventHandler;

use App\CMS\Application\Operation\Write\SendContact\ContactWasSent;
use Mono\Component\Core\Infrastructure\Notifier\BrowserNotificationInterface;
use Mono\Component\Core\Infrastructure\Notifier\NotificationContext;
use Symfony\Component\Messenger\Handler\MessageSubscriberInterface;
use Symfony\Component\Notifier\Notification\Notification;
use Symfony\Component\Notifier\NotifierInterface;
use Symfony\Component\Notifier\Recipient\NoRecipient;
use Symfony\Contracts\Translation\TranslatorInterface;

final class FlashNotifier implements MessageSubscriberInterface
{
    public function __construct(
        private NotifierInterface $notifier,
        private TranslatorInterface $translator
    ) {
    }

    public function __invoke(BrowserNotificationInterface $event): void
    {
        $notification = $this->buildNotification($event->asBrowserNotification());
        $this->notifier->send($notification, new NoRecipient());
    }

    /**
     * @return iterable<string>
     */
    public static function getHandledMessages(): iterable
    {
        yield ContactWasSent::class;
    }

    private function buildNotification(NotificationContext $context): Notification
    {
        $message = $this->translator->trans(
            sprintf('flash.front.%s', $context->getMessage()),
            $context->getParameters(),
            'notification'
        );

        $notification = (new Notification($message, ['browser']))
            ->importance($context->getImportance());

        return $notification;
    }
}
