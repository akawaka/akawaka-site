<?php

declare(strict_types=1);

namespace App\Contact\Infrastructure\AdminSecurity\EventHandler;

use App\Contact\Infrastructure\Mailer\Email;
use App\Contact\Infrastructure\Mailer\MailerInterface;
use Mono\Bundle\AkaBundle\Security\PasswordRecovery\Application\Operation\Write\CreatePasswordRecovery\PasswordRecoveryWasCreated;
use Mono\Bundle\CoreBundle\Application\Operation\AbstractEvent;
use Mono\Bundle\CoreBundle\Infrastructure\Notifier\MailerContext;
use Symfony\Component\Messenger\Handler\MessageSubscriberInterface;
use Symfony\Component\Mime\Address;
use Symfony\Contracts\Translation\TranslatorInterface;
use Mono\Bundle\AkaBundle\Security\PasswordRecovery\Application\Gateway\FindPasswordRecoveryById;

final class RecoveryHandler implements MessageSubscriberInterface
{
    public function __construct(
        private FindPasswordRecoveryById\Gateway $gateway,
        private MailerInterface $mailer,
        private TranslatorInterface $translator,
    ) {
    }

    public function __invoke(AbstractEvent $event): void
    {
        $this->sendNotification($this->buildContext(
            $this->find($event->getId())
        ));
    }

    /**
     * @return iterable<string>
     */
    public static function getHandledMessages(): iterable
    {
        yield PasswordRecoveryWasCreated::class;
    }

    private function find(string $id): FindPasswordRecoveryById\Response
    {
        return ($this->gateway)(FindPasswordRecoveryById\Request::fromData(['id' => $id]));
    }

    private function buildContext(FindPasswordRecoveryById\Response $response): MailerContext
    {
        $data = $response->data();

        return new MailerContext(
            'admin_security.password_recovered',
            [
                'username' => $data['user']['username'],
                'token' => $data['token'],
            ],
            new Address($data['user']['email']),
        );
    }

    private function sendNotification(MailerContext $context): void
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
