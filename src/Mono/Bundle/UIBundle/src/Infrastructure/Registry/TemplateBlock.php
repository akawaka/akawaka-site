<?php

declare(strict_types=1);

namespace Mono\Bundle\UIBundle\Infrastructure\Registry;

final class TemplateBlock
{
    public function __construct(
        private string $name,
        private string $eventName,
        private string $template,
        private array $context = [],
        private int $priority = 0,
        private bool $enabled = true,
    ) {
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEventName(): string
    {
        return $this->eventName;
    }

    public function getTemplate(): string
    {
        return $this->template;
    }

    public function getContext(): array
    {
        return $this->context;
    }

    public function getPriority(): int
    {
        return $this->priority;
    }

    public function isEnabled(): bool
    {
        return $this->enabled;
    }

    public function overwriteWith(self $block): self
    {
        if ($this->name !== $block->name) {
            throw new \DomainException(sprintf(
                'Trying to overwrite block "%s" with block "%s".',
                $this->name,
                $block->name
            ));
        }

        return new self(
            $this->name,
            $block->eventName,
            $block->template ?? $this->template,
            $block->context ?? $this->context,
            $block->priority ?? $this->priority,
            $block->enabled ?? $this->enabled
        );
    }
}
