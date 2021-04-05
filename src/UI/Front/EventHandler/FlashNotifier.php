<?php

declare(strict_types=1);

namespace App\UI\Front\EventHandler;

use App\Cms\Application\Operation\Write\SendContact\ContactWasSent;
use Black\Component\Core\Infrastructure\Notifier\BrowserNotificationInterface;
use Black\Component\Core\Infrastructure\Notifier\NotificationContext;
use Symfony\Component\Messenger\Handler\MessageSubscriberInterface;
use Symfony\Component\Notifier\Notification\Notification;
use Symfony\Component\Notifier\NotifierInterface;
use Symfony\Component\Notifier\Recipient\NoRecipient;
use Symfony\Contracts\Translation\TranslatorInterface;

final class FlashNotifier implements MessageSubscriberInterface
{
    private NotifierInterface $notifier;

    private TranslatorInterface $translator;

    public function __construct(
        NotifierInterface $notifier,
        TranslatorInterface $translator
    ) {
        $this->notifier = $notifier;
        $this->translator = $translator;
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
            $context->getMessage(),
            $context->getParameters(),
            'notification'
        );

        $notification = (new Notification($message, ['browser']))
            ->importance($context->getImportance());

        return $notification;
    }
}
