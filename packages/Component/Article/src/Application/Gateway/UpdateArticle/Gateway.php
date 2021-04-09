<?php

declare(strict_types=1);

namespace Mono\Component\Article\Application\Gateway\UpdateArticle;

use Mono\Component\Article\Application\Operation\Read\FindArticleById;
use Mono\Component\Article\Application\Operation\Read\FindCategoryById;
use Mono\Component\Article\Application\Operation\Write\UpdateArticle\Command;
use Mono\Component\Core\Application\Gateway\GatewayException;
use Mono\Component\Core\Infrastructure\MessageBus\CommandBusInterface;
use Mono\Component\Core\Infrastructure\MessageBus\QueryBusInterface;

final class Gateway
{
    public function __construct(
        private Instrumentation $instrumentation,
        private CommandBusInterface $commandBus,
        private QueryBusInterface $queryBus,
    ) {
    }

    public function __invoke(Request $request): Response
    {
        $this->instrumentation->start($request);
        $categories = [];

        try {
            $article = ($this->queryBus)(new FindArticleById\Query($request->getIdentifier()));

            foreach ($request->getCategories() as $category) {
                $categories[] = ($this->queryBus)(new FindCategoryById\Query(
                    $category,
                ));
            }

            $response = new Response(($this->commandBus)(new Command(
                $article,
                $request->getName(),
                $request->getSlug(),
                $request->getContent(),
                $categories,
            )));

            $this->instrumentation->success($response);

            return $response;
        } catch (\Exception $exception) {
            $this->instrumentation->error($request, $exception->getMessage());

            throw new GatewayException('Error during update article process', $exception->getFile(), $exception->getMessage());
        }
    }
}
