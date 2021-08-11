<?php

declare(strict_types=1);

namespace App\Contact\Application\Operation\Write\Send;

use App\Contact\Domain\Message\Contact;
use App\Contact\Infrastructure\Mailer\Email;
use App\Contact\Infrastructure\Mailer\MailerInterface;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\DispatchAfterCurrentBusStamp;

final class Handler implements MessageHandlerInterface
{
    public function __construct(
        private MailerInterface $mailer,
        private MessageBusInterface $eventBus
    ) {
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
        $this->eventBus->dispatch(
            (new Envelope(new ContactWasSent()))
                ->with(new DispatchAfterCurrentBusStamp())
        );

        return $email;
    }
}
