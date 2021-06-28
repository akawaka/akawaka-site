<?php

declare(strict_types=1);

namespace Mono\Component\Article\Application\Gateway\Article\CreateArticle;

use Mono\Component\Article\Domain\Common\Identifier\ArticleId;
use Mono\Component\Core\Application\Gateway\GatewayResponse;

final class Response implements GatewayResponse
{
    public function __construct(
        private ArticleId $id,
        private bool $success
    ) {
    }

    public function getId(): ArticleId
    {
        return $this->id;
    }

    public function getSuccess(): bool
    {
        return $this->success;
    }

    public function data(): array
    {
        return [
            'identifier' => $this->getId()->getValue(),
            'success' => $this->getSuccess(),
        ];
    }
}
