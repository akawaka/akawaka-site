<?php

declare(strict_types=1);

namespace App\Cms\Application\Operation\Write\SendContact;

use App\Cms\Domain\Message\Contact;
use App\Infrastructure\Mailer\Email;
use App\Infrastructure\Mailer\MailerInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Messenger\MessageBusInterface;

final class Handler implements MessageHandlerInterface
{
    private MailerInterface $mailer;

    private MessageBusInterface $bus;

    public function __construct(
        MailerInterface $mailer,
        MessageBusInterface $bus
    ) {
        $this->mailer = $mailer;
        $this->bus = $bus;
    }

    public function __invoke(Command $command): Email
    {
        $email = (new Contact(
            $this->mailer->getSender(),
            $command->getFirstname(),
            $command->getLastname(),
            $command->getEmail(),
            $command->getPhone(),
            $command->getMessage(),
            $command->getBudget(),
            $command->getHow(),
        ))->getEmail();

        $this->mailer->send($email);
        $this->bus->dispatch(new ContactWasSent($email));

        return $email;
    }
}
