<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Infrastructure\Listener;

use Mono\Bundle\AoBundle\Infrastructure\Context\ChannelContext;
use Symfony\Component\HttpKernel\Event\RequestEvent;

final class RequestListener
{
    public function __construct(
        private ChannelContext $context,
    ) {
    }

    public function __invoke(RequestEvent $event): void
    {
        if (false === $event->isMasterRequest()) {
            return;
        }

        $request = $event->getRequest();

        if (null !== $request->request->get('ao')) {
            return;
        }
        $channel = $this->context->getChannel($request);

        $request->request->add(['ao' => ['channel' => $channel]]);
    }
}
