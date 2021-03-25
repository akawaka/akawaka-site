<?php

declare(strict_types=1);

namespace Black\Bundle\PeanutBundle\Application\Page\Gateway\FindPagesByStatus;

use Black\Bundle\CoreBundle\Application\GatewayException;
use Black\Bundle\PeanutBundle\Application\Page\Gateway\FindPagesByStatus\Response\PageResponse;
use Black\Bundle\PeanutBundle\Application\Page\Query\QueryFindPagesByStatus;
use Black\Bundle\PeanutBundle\Application\Page\QueryHandler\HandleFindPagesByStatus;

final class FindPagesByStatusGateway
{
    private Instrumentation $instrumentation;

    private HandleFindPagesByStatus $queryHandler;

    public function __construct(
        Instrumentation $instrumentation,
        HandleFindPagesByStatus $queryHandler
    ) {
        $this->instrumentation = $instrumentation;
        $this->queryHandler = $queryHandler;
    }

    public function __invoke(FindPagesByStatusRequest $request): FindPagesByStatusResponse
    {
        $this->instrumentation->find($request);

        try {
            $pages = ($this->queryHandler)(new QueryFindPagesByStatus(
                $request->getStatus(),
                $request->getPage(),
            ));

            $response = new FindPagesByStatusResponse();
            foreach ($pages as $page) {
                $response->add(new PageResponse($page));
            }

            $this->instrumentation->found($response);

            return $response;
        } catch (\Exception $exception) {
            $this->instrumentation->notFound($request, $exception->getMessage());

            throw new GatewayException('Pages not found', $exception->getFile(), $exception->getMessage());
        }
    }
}
