<?php

declare(strict_types=1);

namespace Mono\Bundle\UIBundle\Infrastructure\Registry;

final class TemplateBlockRegistry implements TemplateBlockRegistryInterface
{
    private $serial = PHP_INT_MAX;

    public function __construct(
        private array $eventsToTemplateBlocks = []
    ) {
    }

    public function all(): array
    {
        return $this->eventsToTemplateBlocks;
    }

    public function findEnabledForEvents(array $eventNames): array
    {
        // No need to sort blocks again if there's only one event because we have them sorted already
        if (count($eventNames) === 1) {
            $eventName = reset($eventNames);

            return array_values(array_filter(
                $this->eventsToTemplateBlocks[$eventName] ?? [],
                static function (TemplateBlock $templateBlock): bool {
                    return $templateBlock->isEnabled();
                }
            ));
        }

        $enabledFinalizedTemplateBlocks = array_filter(
            $this->findFinalizedForEvents($eventNames),
            static function (TemplateBlock $templateBlock): bool {
                return $templateBlock->isEnabled();
            }
        );

        $templateBlocksPriorityQueue = new \SplPriorityQueue();
        foreach ($enabledFinalizedTemplateBlocks as $templateBlock) {
            $priority = $templateBlock->getPriority();

            if (false === is_array($priority)) {
                $priority = [$templateBlock->getPriority(), $this->serial--];
            }

            $templateBlocksPriorityQueue->insert($templateBlock, $priority);
        }

        $events = [];
        foreach (clone $templateBlocksPriorityQueue as $item) {
            $events[] = $item;
        }

        return $events;
    }

    private function findFinalizedForEvents(array $eventNames): array
    {
        $finalizedTemplateBlocks = [];
        $reversedEventNames = array_reverse($eventNames);
        foreach ($reversedEventNames as $eventName) {
            $templateBlocks = $this->eventsToTemplateBlocks[$eventName] ?? [];
            foreach ($templateBlocks as $blockName => $templateBlock) {
                if (array_key_exists($blockName, $finalizedTemplateBlocks)) {
                    $templateBlock = $finalizedTemplateBlocks[$blockName]->overwriteWith($templateBlock);
                }

                $finalizedTemplateBlocks[$blockName] = $templateBlock;
            }
        }

        return $finalizedTemplateBlocks;
    }
}
