<?php

declare(strict_types=1);

namespace Black\Bundle\CoreBundle\Infrastructure\Notifier;

final class NotificationContext
{
    private string $message;

    private string $importance;

    private array $parameters;

    public function __construct(
        string $message = '',
        string $importance = 'info',
        array $parameters = []
    ) {
        $this->message = $message;
        $this->importance = $importance;
        $this->parameters = $parameters;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function getImportance(): string
    {
        return $this->importance;
    }

    public function getParameters(): array
    {
        return $this->parameters;
    }
}
