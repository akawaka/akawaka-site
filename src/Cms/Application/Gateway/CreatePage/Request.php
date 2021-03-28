<?php

declare(strict_types=1);

namespace App\Cms\Application\Gateway\CreatePage;

use Black\Component\Core\Application\Gateway\GatewayRequest;
use JetBrains\PhpStorm\ArrayShape;
use Symfony\Component\PropertyAccess\PropertyAccess;

final class Request implements GatewayRequest
{
    private string $name;

    private ?string $slug;

    private string $channel;

    private function __construct()
    {
        $this->slug = null;
    }

    public static function fromData(array $data = []): self
    {
        $dto = new self();
        $fields = [
            'name',
            'channel'
        ];

        $optionalFields = [
            'slug',
        ];

        $accessor = PropertyAccess::createPropertyAccessor();
        foreach ($fields as $field) {
            $dto->{$field} = $accessor->getValue($data, "[$field]");
        }

        foreach ($optionalFields as $field) {
            if (true === isset($optionalFields[$field])) {
                $dto->{$field} = $accessor->getValue($data, "[$field]");
            }
        }

        return $dto;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function getChannel(): string
    {
        return $this->channel;
    }

    #[ArrayShape(['name' => "string", 'slug' => "string", 'channel' => "string"])]
    public function data(): array
    {
        return [
            'name' => $this->getName(),
            'slug' => $this->getSlug(),
            'channel' => $this->getChannel(),
        ];
    }
}
