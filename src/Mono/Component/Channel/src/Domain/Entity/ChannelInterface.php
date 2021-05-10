<?php

declare(strict_types=1);

namespace Mono\Component\Channel\Domain\Entity;

use Mono\Component\Channel\Domain\Identifier\ChannelId;
use Mono\Component\Channel\Domain\ValueObject\ChannelCode;

interface ChannelInterface
{
    public function getId(): ChannelId;

    public function getName(): string;

    public function getCode(): ChannelCode;

    public function getUrl(): ?string;

    public function getDescription(): ?string;

    public function getStatus(): string;

    public function getCreationDate(): \DateTimeImmutable;

    public function getLastUpdate(): ?\DateTimeImmutable;
}
