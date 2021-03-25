<?php

declare(strict_types=1);

namespace Black\Bundle\PeanutBundle\Application\Page\Gateway\FindPageBySlug;

use Black\Bundle\CoreBundle\Application\GatewayException;
use Black\Bundle\PeanutBundle\Application\Page\Query\QueryFindPageBySlug;
use Black\Bundle\PeanutBundle\Application\Page\QueryHandler\HandleFindPageBySlug;

final class FindPageBySlugGateway
{
    private Instrumentation $instrumentation;

    private HandleFindPageBySlug $queryHandler;

    public function __construct(
        Instrumentation $instrumentation,
        HandleFindPageBySlug $queryHandler
    ) {
        $this->instrumentation = $instrumentation;
        $this->queryHandler = $queryHandler;
    }

    public function __invoke(FindPageBySlugRequest $request): FindPageBySlugResponse
    {
        $this->instrumentation->find($request);

        try {
            $page = ($this->queryHandler)(new QueryFindPageBySlug(
                $request->getSlug(),
            ));

            $response = new FindPageBySlugResponse($page);
            $this->instrumentation->found($response);

            return $response;
        } catch (\Exception $exception) {
            $this->instrumentation->notFound($request, $exception->getMessage());

            throw new GatewayException('Page not found', $exception->getFile(), $exception->getMessage());
        }
    }
}
