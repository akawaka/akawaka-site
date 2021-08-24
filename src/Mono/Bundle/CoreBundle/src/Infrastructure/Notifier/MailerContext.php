<?php

declare(strict_types=1);

namespace Mono\Bundle\CoreBundle\Infrastructure\Notifier;

use Symfony\Component\Mime\Address;

final class MailerContext
{
    private array $recipients;

    public function __construct(
        private string $subject,
        private array $parameters = [],
        Address ...$recipients,
    ) {
        $this->recipients = $recipients;
    }

    public function getSubject(): string
    {
        return $this->subject;
    }

    public function getRecipients(): array
    {
        return $this->recipients;
    }

    public function getParameters(): array
    {
        return $this->parameters;
    }
}
