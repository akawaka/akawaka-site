<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Security\Application\AdminSecurity\EventHandler;

use Mono\Bundle\AoBundle\CMS\Infrastructure\Mailer\Email;
use Mono\Bundle\AoBundle\CMS\Infrastructure\Mailer\MailerInterface;
use Mono\Bundle\AoBundle\Security\Application\AdminSecurity\Operation\Write\ResetPassword\AdminPasswordWasReset;
use Mono\Component\Core\Infrastructure\Notifier\MailerContext;
use Mono\Component\Core\Infrastructure\Notifier\MailerNotificationInterface;
use Symfony\Component\Messenger\Handler\MessageSubscriberInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

final class RecoveryHandler implements MessageSubscriberInterface
{
    public function __construct(
        private MailerInterface $mailer,
        private TranslatorInterface $translator
    ) {
    }

    public function __invoke(MailerNotificationInterface $event): void
    {
        $this->buildNotification($event->asMailerNotification());
    }

    /**
     * @return iterable<string>
     */
    public static function getHandledMessages(): iterable
    {
        yield AdminPasswordWasReset::class;
    }

    private function buildNotification(MailerContext $context): void
    {
        $subject = $this->translator->trans(
            sprintf('mailer.security.%s', $context->getSubject()),
            $context->getParameters(),
            'notification'
        );

        foreach ($context->getRecipients() as $recipient) {
            $email = new Email(
                $recipient,
                $subject,
                'Admin/Security/Emails/recovery.text.twig',
                'Admin/Security/Emails/recovery.html.twig',
                $context->getParameters()
            );

            $this->mailer->send($email);
        }
    }
}
