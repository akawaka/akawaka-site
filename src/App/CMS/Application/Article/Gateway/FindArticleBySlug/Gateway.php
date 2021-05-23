<?php

declare(strict_types=1);

namespace App\CMS\Application\Article\Gateway\FindArticleBySlug;

use App\CMS\Application\Article\Operation\Read\FindArticleBySlug;
use Mono\Component\Core\Application\Gateway\GatewayException;
use Mono\Component\Core\Infrastructure\MessageBus\QueryBusInterface;

final class Gateway
{
    public function __construct(
        private Instrumentation $instrumentation,
        private QueryBusInterface $queryBus,
    ) {
    }

    public function __invoke(Request $request): Response
    {
        $this->instrumentation->start($request);

        try {
            $article = ($this->queryBus)(new FindArticleBySlug\Query($request->getSlug()));
            $response = new Response($article);

            $this->instrumentation->success($response);

            return $response;
        } catch (\Exception $exception) {
            $this->instrumentation->error($request, $exception->getMessage());

            throw new GatewayException('Error during find article by slug process', $exception->getFile(), $exception->getMessage());
        }
    }
}
