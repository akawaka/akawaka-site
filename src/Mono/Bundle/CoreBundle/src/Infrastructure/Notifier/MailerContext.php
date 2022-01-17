<?php

declare(strict_types=1);

namespace Mono\Bundle\CoreBundle\Infrastructure\Notifier;

use Symfony\Component\Mime\Address;

final class MailerContext
{
    /** @var Address[] */
    private array $recipients;

    /**
     * @param string               $subject
     * @param array<string,string> $parameters
     * @param Address              ...$recipients
     */
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

    /**
     * @return Address[]
     */
    public function getRecipients(): array
    {
        return $this->recipients;
    }

    /**
     * @return array<string,string>
     */
    public function getParameters(): array
    {
        return $this->parameters;
    }
}
