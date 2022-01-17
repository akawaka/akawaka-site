<?php

declare(strict_types=1);

namespace Mono\Bundle\CoreBundle\Infrastructure\Notifier;

final class BrowserContext
{
    /**
     * @param string               $subject
     * @param string               $alert
     * @param array<string,string> $parameters
     */
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

    /**
     * @return array<string,string>
     */
    public function getParameters(): array
    {
        return $this->parameters;
    }
}
