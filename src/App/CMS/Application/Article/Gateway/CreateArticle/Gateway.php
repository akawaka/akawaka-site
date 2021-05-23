<?php

declare(strict_types=1);

namespace App\CMS\Application\Article\Gateway\CreateArticle;

use App\CMS\Application\Article\Operation\Write\CreateArticle\Command;
use Mono\Component\Core\Application\Gateway\GatewayException;
use Mono\Component\Core\Infrastructure\MessageBus\CommandBusInterface;

final class Gateway
{
    public function __construct(
        private Instrumentation $instrumentation,
        private CommandBusInterface $commandBus,
    ) {
    }

    public function __invoke(Request $request): Response
    {
        $this->instrumentation->start($request);

        try {
            $response = new Response(($this->commandBus)(new Command(
                $request->getName(),
                $request->getSlug(),
                $request->getCategories(),
                $request->getSpaces(),
            )));

            $this->instrumentation->success($response);

            return $response;
        } catch (\Exception $exception) {
            $this->instrumentation->error($request, $exception->getMessage());

            throw new GatewayException('Error during create article process', $exception->getFile(), $exception->getMessage());
        }
    }
}
