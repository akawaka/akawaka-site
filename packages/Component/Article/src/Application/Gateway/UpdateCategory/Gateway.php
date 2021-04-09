<?php

declare(strict_types=1);

namespace Mono\Component\Article\Application\Gateway\UpdateCategory;

use Mono\Component\Article\Application\Operation\Read\FindCategoryById;
use Mono\Component\Article\Application\Operation\Write\UpdateCategory\Command;
use Mono\Component\Core\Application\Gateway\GatewayException;
use Mono\Component\Core\Infrastructure\MessageBus\CommandBusInterface;
use Mono\Component\Core\Infrastructure\MessageBus\QueryBusInterface;
use Symfony\Component\Messenger\HandleTrait;

final class Gateway
{
    use HandleTrait;

    public function __construct(
        private Instrumentation $instrumentation,
        private CommandBusInterface $commandBus,
        private QueryBusInterface $queryBus,
    ) {
    }

    public function __invoke(Request $request): Response
    {
        $this->instrumentation->start($request);

        try {
            $category = ($this->queryBus)(new FindCategoryById\Query($request->getIdentifier()));
            $response = new Response(($this->commandBus)(new Command(
                $category,
                $request->getName(),
                $request->getSlug(),
            )));

            $this->instrumentation->success($response);

            return $response;
        } catch (\Exception $exception) {
            $this->instrumentation->error($request, $exception->getMessage());

            throw new GatewayException('Error during update category process', $exception->getFile(), $exception->getMessage());
        }
    }
}
