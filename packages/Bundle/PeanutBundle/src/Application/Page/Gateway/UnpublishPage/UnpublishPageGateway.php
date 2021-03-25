<?php

declare(strict_types=1);

namespace Black\Bundle\PeanutBundle\Application\Page\Gateway\UnpublishPage;

use Black\Bundle\CoreBundle\Application\GatewayException;
use Black\Bundle\PeanutBundle\Application\Page\Command\CommandUnpublishPage;
use Black\Bundle\PeanutBundle\Application\Page\Query\QueryFindPageById;
use Black\Bundle\PeanutBundle\Application\Page\QueryHandler\HandleFindPageById;
use Symfony\Component\Messenger\MessageBusInterface;

final class UnpublishPageGateway
{
    private Instrumentation $instrumentation;

    private HandleFindPageById $queryHandler;

    private MessageBusInterface $commandBus;

    public function __construct(
        Instrumentation $instrumentation,
        HandleFindPageById $queryHandler,
        MessageBusInterface $commandBus
    ) {
        $this->instrumentation = $instrumentation;
        $this->queryHandler = $queryHandler;
        $this->commandBus = $commandBus;
    }

    public function __invoke(UnpublishPageRequest $request): UnpublishPageResponse
    {
        $this->instrumentation->unpublish($request);

        try {
            $page = ($this->queryHandler)(new QueryFindPageById($request->getId()));
            $this->commandBus->dispatch(new CommandUnpublishPage(
                $page,
            ));

            $response = new UnpublishPageResponse($page->getId());
            $this->instrumentation->unpublishd($response);

            return $response;
        } catch (\Exception $exception) {
            $this->instrumentation->notUnpublishd($request, $exception->getMessage());

            throw new GatewayException('Page not unpublishd', $exception->getFile(), $exception->getMessage());
        }
    }
}
