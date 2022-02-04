<?php

declare(strict_types=1);

namespace Mono\Bundle\CoreBundle\Application\Instrumentation;

use Mono\Bundle\CoreBundle\Application\Gateway\GatewayRequest;
use Mono\Bundle\CoreBundle\Application\Gateway\GatewayResponse;
use Mono\Bundle\CoreBundle\Infrastructure\Instrumentation\LoggerInstrumentation;
use Psr\Log\LoggerInterface;

abstract class AbstractGatewayInstrumentation implements GatewayInstrumentationInterface
{
    private LoggerInterface $logger;

    public function __construct(LoggerInstrumentation $instrumentation)
    {
        $this->logger = $instrumentation->getLogger();
    }

    public function start(GatewayRequest $request): void
    {
        // @phpstan-ignore-next-line
        $this->logger->info(static::NAME, $request->data());
    }

    public function success(GatewayResponse $response): void
    {
        // @phpstan-ignore-next-line
        $this->logger->info(\Safe\sprintf('%s.success', static::NAME), $response->data());
    }

    public function error(GatewayRequest $request, string $reason): void
    {
        // @phpstan-ignore-next-line
        $this->logger->error(\Safe\sprintf('%s.error', static::NAME), array_merge(
            $request->data(),
            [' reason' => $reason]
        ));
    }
}
