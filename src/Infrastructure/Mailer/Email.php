<?php

declare(strict_types=1);

namespace App\Infrastructure\Mailer;

use Symfony\Component\Mime\Address;

final class Email
{
    private Address $receiverEmail;

    private string $subject;

    private string $textTemplate;

    private string $htmlTemplate;

    private array $parameters;

    public function __construct(
        Address $receiverEmail,
        string $subject,
        string $textTemplate,
        string $htmlTemplate,
        array $parameters
    ) {
        $this->receiverEmail = $receiverEmail;
        $this->subject = $subject;
        $this->textTemplate = $textTemplate;
        $this->htmlTemplate = $htmlTemplate;
        $this->parameters = $parameters;
    }

    public function getReceiverEmail(): Address
    {
        return $this->receiverEmail;
    }

    public function getSubject(): string
    {
        return $this->subject;
    }

    public function getTextTemplate(): string
    {
        return $this->textTemplate;
    }

    public function getHtmlTemplate(): string
    {
        return $this->htmlTemplate;
    }

    /**
     * @return mixed[]
     */
    public function getParameters(): array
    {
        return $this->parameters;
    }
}
