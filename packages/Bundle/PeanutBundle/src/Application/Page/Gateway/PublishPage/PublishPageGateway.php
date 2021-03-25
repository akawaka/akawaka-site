<?php

declare(strict_types=1);

namespace Black\Bundle\PeanutBundle\Application\Page\Gateway\PublishPage;

use Black\Bundle\CoreBundle\Application\GatewayException;
use Black\Bundle\PeanutBundle\Application\Page\Command\CommandPublishPage;
use Black\Bundle\PeanutBundle\Application\Page\Query\QueryFindPageById;
use Black\Bundle\PeanutBundle\Application\Page\QueryHandler\HandleFindPageById;
use Symfony\Component\Messenger\MessageBusInterface;

final class PublishPageGateway
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

    public function __invoke(PublishPageRequest $request): PublishPageResponse
    {
        $this->instrumentation->publish($request);

        try {
            $page = ($this->queryHandler)(new QueryFindPageById($request->getId()));
            $this->commandBus->dispatch(new CommandPublishPage(
                $page,
            ));

            $response = new PublishPageResponse($page->getId());
            $this->instrumentation->publishd($response);

            return $response;
        } catch (\Exception $exception) {
            $this->instrumentation->notPublishd($request, $exception->getMessage());

            throw new GatewayException('Page not publishd', $exception->getFile(), $exception->getMessage());
        }
    }
}
