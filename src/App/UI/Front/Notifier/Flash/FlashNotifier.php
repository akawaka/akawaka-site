<?php

declare(strict_types=1);

namespace App\UI\Front\Notifier\Flash;

use Symfony\Component\Notifier\Notification\Notification;
use Symfony\Component\Notifier\NotifierInterface;
use Symfony\Component\Notifier\Recipient\NoRecipient;
use Symfony\Contracts\Translation\TranslatorInterface;

final class FlashNotifier
{
    public function __construct(
        private NotifierInterface $notifier,
        private TranslatorInterface $translator
    ) {
    }

    public function __invoke(string $message, string $level = 'info', array $parameters = []): void
    {
        $message = $this->translator->trans(
            sprintf('flash.front.%s', $message),
            $parameters,
            'notification'
        );

        $notification = (new Notification($message, ['browser']))
            ->importance($level)
        ;

        $this->notifier->send($notification, new NoRecipient());
    }
}
