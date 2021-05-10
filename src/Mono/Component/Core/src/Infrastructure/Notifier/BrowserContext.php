<?php

declare(strict_types=1);

namespace Mono\Component\Core\Infrastructure\Notifier;

final class BrowserContext
{
    public function __construct(
        private string $subject,
        private string $alert = 'info',
        private array $parameters = []
    ) {
    }

    public function getSubject(): string
    {
        return $this->subject;
    }

    public function getAlert(): string
    {
        return $this->alert;
    }

    public function getParameters(): array
    {
        return $this->parameters;
    }
}
