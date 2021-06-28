<?php

declare(strict_types=1);

namespace App\CMS\Application\Page\Gateway\UpdatePage;

use Mono\Component\Core\Application\Gateway\GatewayException;
use Mono\Component\Core\Infrastructure\MessageBus\CommandBusInterface;
use App\CMS\Application\Page\Operation\Write\Update\Command;
use Mono\Component\Page\Application\Gateway\UpdatePage\Instrumentation;

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
                $request->getIdentifier(),
                $request->getName(),
                $request->getSlug(),
                $request->getContent(),
                $request->getSpaces(),
            )));

            $this->instrumentation->success($response);

            return $response;
        } catch (\Exception $exception) {
            $this->instrumentation->error($request, $exception->getMessage());

            throw new GatewayException('Error during update page process', $exception->getFile(), $exception->getMessage());
        }
    }
}
