<?php

declare(strict_types=1);

namespace App\CMS\Application\Gateway\CreateArticle;

use App\CMS\Application\Operation\Write\CreateArticle\Command;
use Mono\Component\Article\Application\Operation\Read\FindCategoryById;
use Mono\Component\Channel\Application\Operation\Read\FindById;
use Mono\Component\Core\Application\Gateway\GatewayException;
use Mono\Component\Core\Infrastructure\MessageBus\CommandBusInterface;
use Mono\Component\Core\Infrastructure\MessageBus\QueryBusInterface;

final class Gateway
{
    public function __construct(
        private Instrumentation $instrumentation,
        private QueryBusInterface $queryBus,
        private CommandBusInterface $commandBus,
    ) {
    }

    public function __invoke(Request $request): Response
    {
        $this->instrumentation->start($request);
        $categories = [];
        $channels = [];

        try {
            foreach ($request->getChannels() as $channel) {
                $channels[] = ($this->queryBus)(new FindById\Query(
                    $channel,
                ));
            }

            foreach ($request->getCategories() as $category) {
                $categories[] = ($this->queryBus)(new FindCategoryById\Query(
                    $category,
                ));
            }

            $response = new Response(($this->commandBus)(new Command(
                $request->getName(),
                $request->getSlug(),
                $categories,
                $channels,
            )));

            $this->instrumentation->success($response);

            return $response;
        } catch (\Exception $exception) {
            $this->instrumentation->error($request, $exception->getMessage());

            throw new GatewayException('Error during create article process', $exception->getFile(), $exception->getMessage());
        }
    }
}
