<?php

declare(strict_types=1);

namespace App\Infrastructure\Mailer;

use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface as SymfonyMailerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mime\Address;
use Symfony\Contracts\Translation\TranslatorInterface;

class SymfonyMailer implements MailerInterface
{
    private SymfonyMailerInterface $mailer;

    private TranslatorInterface $translator;

    private string $senderEmail;

    private string $senderName;

    public function __construct(
        SymfonyMailerInterface $mailer,
        TranslatorInterface $translator,
        string $senderEmail,
        string $senderName
    ) {
        $this->mailer = $mailer;
        $this->translator = $translator;
        $this->senderEmail = $senderEmail;
        $this->senderName = $senderName;
    }

    public function getSender(): Address
    {
        return new Address($this->senderEmail, $this->senderName);
    }

    public function send(Email $email): bool
    {
        $mail = (new TemplatedEmail())
            ->from($this->getSender())
            ->to($email->getReceiverEmail())
            ->subject($this->translator->trans(
                $email->getSubject(),
                $email->getParameters(),
                'mails'
            ))
            ->htmlTemplate($email->getHtmlTemplate())
            ->textTemplate($email->getTextTemplate())
            ->context($email->getParameters())
        ;

        try {
            $this->mailer->send($mail);
        } catch (TransportExceptionInterface $exception) {
            return false;
        }

        return true;
    }
}
