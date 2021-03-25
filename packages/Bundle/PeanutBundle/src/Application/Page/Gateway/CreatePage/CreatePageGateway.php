<?php

declare(strict_types=1);

namespace Black\Bundle\PeanutBundle\Application\Page\Gateway\CreatePage;

use Black\Bundle\CoreBundle\Application\GatewayException;
use Black\Bundle\PeanutBundle\Application\Page\Command\CommandCreatePage;
use Black\Bundle\PeanutBundle\Domain\Identifier\PageId;
use Symfony\Component\Messenger\MessageBusInterface;

final class CreatePageGateway
{
    private Instrumentation $instrumentation;

    private MessageBusInterface $commandBus;

    public function __construct(
        Instrumentation $instrumentation,
        MessageBusInterface $commandBus
    ) {
        $this->instrumentation = $instrumentation;
        $this->commandBus = $commandBus;
    }

    public function __invoke(CreatePageRequest $request): CreatePageResponse
    {
        $this->instrumentation->create($request);

        try {
            $id = new PageId();

            $this->commandBus->dispatch(new CommandCreatePage(
                $id,
                $request->getName(),
                $request->getSlug(),
                $request->getContent()
            ));

            $response = new CreatePageResponse($id);
            $this->instrumentation->created($response);

            return $response;
        } catch (\Exception $exception) {
            $this->instrumentation->notCreated($request, $exception->getMessage());

            throw new GatewayException('Page not created', $exception->getFile(), $exception->getMessage());
        }
    }
}
