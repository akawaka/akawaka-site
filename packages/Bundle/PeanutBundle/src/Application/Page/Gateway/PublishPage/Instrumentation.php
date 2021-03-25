<?php

declare(strict_types=1);

namespace Black\Bundle\PeanutBundle\Application\Page\Gateway\PublishPage;

use Black\Bundle\CoreBundle\Infrastructure\Instrumentation\PsrInstrumentation;
use Psr\Log\LoggerInterface;

final class Instrumentation
{
    private LoggerInterface $logger;

    public function __construct(PsrInstrumentation $instrumentation)
    {
        $this->logger = $instrumentation->getLogger();
    }

    public function publish(PublishPageRequest $request): void
    {
        $this->logger->info('page.publish_page', $request->data());
    }

    public function publishd(PublishPageResponse $response): void
    {
        $this->logger->info('page.publish_page_success', $response->data());
    }

    public function notPublishd(PublishPageRequest $request, string $reason): void
    {
        $this->logger->error('page.publish_page_error', array_merge($request->data(),
            ['reason' => $reason]
        ));
    }
}
