<?php

declare(strict_types=1);

namespace App\CMS\Domain\Message;

use App\Infrastructure\Mailer\Email;
use Symfony\Component\Mime\Address;

final class Contact
{
    private Address $recipient;

    private string $firstname;

    private string $lastname;

    private string $email;

    private ?string $phone;

    private string $message;

    private string $budget;

    private ?string $how;

    public function __construct(
        Address $recipient,
        string $firstname,
        string $lastname,
        string $email,
        ?string $phone,
        string $message,
        string $budget,
        ?string $how,
    ) {
        $this->recipient = $recipient;
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->email = $email;
        $this->phone = $phone;
        $this->message = $message;
        $this->budget = $budget;
        $this->how = $how;
    }

    public function getEmail(): Email
    {
        return new Email(
            $this->recipient,
            'New mail from akawaka',
            'front/emails/contact.txt.twig',
            'front/emails/contact.html.twig',
            [
                'firstname' => $this->firstname,
                'lastname' => $this->lastname,
                'fromEmail' => $this->email,
                'phone' => $this->phone,
                'message' => $this->message,
                'budget' => $this->budget,
                'how' => $this->how,
            ],
        );
    }
}