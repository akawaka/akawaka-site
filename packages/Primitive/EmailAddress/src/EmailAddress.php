<?php

declare(strict_types=1);

namespace Mono\Primitive\EmailAddress;

final class EmailAddress
{
    private string $recipient;

    private string $domain;

    private string $tld;

    public function __construct(string $email)
    {
        if (false === filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidEmailAddressException($email);
        }

        $this->explodeEmail($email);
    }

    public function __toString(): string
    {
        return $this->getValue();
    }

    public function getValue(): string
    {
        return \Safe\sprintf('%s@%s.%s',
            $this->recipient,
            $this->domain,
            $this->tld
        );
    }

    public function getValueAsArray(): array
    {
        return [
            'recipient' => $this->getRecipient(),
            'domain' => $this->getDomain(),
            'tld' => $this->getTld(),
        ];
    }

    public function getRecipient(): string
    {
        return $this->recipient;
    }

    public function getDomain(): string
    {
        return $this->domain;
    }

    public function getTld(): string
    {
        return $this->tld;
    }

    public function isEqualTo(EmailAddress $emailAddress): bool
    {
        return $this->getValue() === $emailAddress->getValue();
    }

    private function explodeEmail(string $email): void
    {
        [$recipient, $domain] = explode('@', $email);
        [$domain, $tld] = explode('.', $domain, 2);

        $this->recipient = $recipient;
        $this->domain = $domain;
        $this->tld = $tld;
    }
}
