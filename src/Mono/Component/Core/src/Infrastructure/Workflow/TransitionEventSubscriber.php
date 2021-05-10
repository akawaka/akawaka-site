<?php

declare(strict_types=1);

namespace Mono\Component\Core\Infrastructure\Workflow;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Workflow\Event\TransitionEvent;

final class TransitionEventSubscriber implements EventSubscriberInterface
{
    public function onWorkflowTransition(TransitionEvent $event)
    {
        $context = $event->getContext();
        $context['method'] = $event->getTransition()->getName();

        $event->setContext($context);
    }

    public static function getSubscribedEvents()
    {
        return [
            TransitionEvent::class => 'onWorkflowTransition',
        ];
    }
}
