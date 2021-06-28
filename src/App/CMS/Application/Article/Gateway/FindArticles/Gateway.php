<?php

declare(strict_types=1);

namespace App\CMS\Application\Article\Gateway\FindArticles;

use Mono\Component\Core\Application\Gateway\GatewayException;
use Mono\Component\Core\Infrastructure\MessageBus\QueryBusInterface;
use Mono\Component\Article\Application\Operation\Article\Read\FindAll\Query;
use Mono\Component\Article\Application\Gateway\Article\FindArticles\Instrumentation;
use Mono\Component\Article\Application\Gateway\Article\FindArticles\Request;

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
            $articles = ($this->queryBus)(new Query());

            $response = new Response();
            foreach ($articles as $article) {
                $response->add($article);
            }

            $this->instrumentation->success($response);

            return $response;
        } catch (\Exception $exception) {
            $this->instrumentation->error($request, $exception->getMessage());

            throw new GatewayException('Error during find articles process', $exception->getFile(), $exception->getMessage());
        }
    }
}
