<?php

declare(strict_types=1);

namespace Black\Bundle\PeanutBundle\Application\Page\Gateway\UnpublishPage;

use Black\Bundle\CoreBundle\Infrastructure\Instrumentation\PsrInstrumentation;
use Psr\Log\LoggerInterface;

final class Instrumentation
{
    private LoggerInterface $logger;

    public function __construct(PsrInstrumentation $instrumentation)
    {
        $this->logger = $instrumentation->getLogger();
    }

    public function unpublish(UnpublishPageRequest $request): void
    {
        $this->logger->info('page.unpublish_page', $request->data());
    }

    public function unpublishd(UnpublishPageResponse $response): void
    {
        $this->logger->info('page.unpublish_page_success', $response->data());
    }

    public function notUnpublishd(UnpublishPageRequest $request, string $reason): void
    {
        $this->logger->error('page.unpublish_page_error', array_merge($request->data(),
            ['reason' => $reason]
        ));
    }
}
