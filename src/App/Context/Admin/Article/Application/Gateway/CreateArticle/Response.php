<?php

declare(strict_types=1);

namespace App\Context\Admin\Article\Application\Gateway\CreateArticle;

use App\Shared\Domain\Identifier\ArticleId;
use Mono\Bundle\CoreBundle\Application\Gateway\GatewayResponse;

final class Response implements GatewayResponse
{
    public function __construct(
        private ArticleId $id,
    ) {
    }

    public function getId(): ArticleId
    {
        return $this->id;
    }

    public function data(): array
    {
        return [
            'identifier' => $this->getId()->getValue(),
        ];
    }
}
