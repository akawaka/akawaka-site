<?php

declare(strict_types=1);

namespace App\CMS\Application\Page\Gateway\CreatePage;

use App\CMS\Application\Page\Operation\Write\Create\Command;
use Mono\Component\Core\Application\Gateway\GatewayException;
use Mono\Component\Core\Infrastructure\MessageBus\CommandBusInterface;
use Mono\Component\Page\Application\Gateway\CreatePage\Instrumentation;
use Mono\Component\Page\Application\Gateway\CreatePage\Response;
use Mono\Component\Page\Infrastructure\Identity\PageIdentityGenerator;

final class Gateway
{
    public function __construct(
        private Instrumentation $instrumentation,
        private PageIdentityGenerator $generator,
        private CommandBusInterface $commandBus,
    ) {
    }

    public function __invoke(Request $request): Response
    {
        $this->instrumentation->start($request);

        try {
            $identity = $this->generator->nextIdentity();

            $command = ($this->commandBus)(new Command(
                $identity,
                $request->getName(),
                $request->getSlug(),
                $request->getSpaces(),
            ));

            $response = new Response($identity, $command);

            $this->instrumentation->success($response);

            return $response;
        } catch (\Exception $exception) {
            $this->instrumentation->error($request, $exception->getMessage());

            throw new GatewayException(
                'Error during create page process',
                $exception->getFile(),
                $exception->getMessage()
            );
        }
    }
}
