<?php

declare(strict_types=1);

namespace Mono\Component\Core\Application\Instrumentation;

use Mono\Component\Core\Application\Gateway\GatewayRequest;
use Mono\Component\Core\Application\Gateway\GatewayResponse;
use Mono\Component\Core\Infrastructure\Instrumentation\LoggerInstrumentation;
use Psr\Log\LoggerInterface;

abstract class AbstractInstrumentation implements InstrumentationInterface
{
    private LoggerInterface $logger;

    public function __construct(LoggerInstrumentation $instrumentation)
    {
        $this->logger = $instrumentation->getLogger();
    }

    public function start(GatewayRequest $request): void
    {
        $this->logger->info(static::NAME, $request->data());
    }

    public function success(GatewayResponse $response): void
    {
        $this->logger->info(\Safe\sprintf('%s.success', static::NAME), $response->data());
    }

    public function error(GatewayRequest $request, string $reason): void
    {
        $this->logger->error(\Safe\sprintf('%s.error', static::NAME), array_merge(
            $request->data(),
            [' reason' => $reason]
        ));
    }
}