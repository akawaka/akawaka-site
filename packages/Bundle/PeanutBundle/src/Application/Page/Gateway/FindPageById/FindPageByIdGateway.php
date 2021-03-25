<?php

declare(strict_types=1);

namespace Black\Bundle\PeanutBundle\Application\Page\Gateway\FindPageById;

use Black\Bundle\CoreBundle\Application\GatewayException;
use Black\Bundle\PeanutBundle\Application\Page\Query\QueryFindPageById;
use Black\Bundle\PeanutBundle\Application\Page\QueryHandler\HandleFindPageById;

final class FindPageByIdGateway
{
    private Instrumentation $instrumentation;

    private HandleFindPageById $queryHandler;

    public function __construct(
        Instrumentation $instrumentation,
        HandleFindPageById $queryHandler
    ) {
        $this->instrumentation = $instrumentation;
        $this->queryHandler = $queryHandler;
    }

    public function __invoke(FindPageByIdRequest $request): FindPageByIdResponse
    {
        $this->instrumentation->find($request);

        try {
            $page = ($this->queryHandler)(new QueryFindPageById(
                $request->getId(),
            ));

            $response = new FindPageByIdResponse($page);
            $this->instrumentation->found($response);

            return $response;
        } catch (\Exception $exception) {
            $this->instrumentation->notFound($request, $exception->getMessage());

            throw new GatewayException('Page not found', $exception->getFile(), $exception->getMessage());
        }
    }
}
