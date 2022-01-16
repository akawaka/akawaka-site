<?php

declare(strict_types=1);

namespace Mono\Bundle\CoreBundle\Infrastructure\Workflow;

use Symfony\Component\Workflow\Exception\LogicException;
use Symfony\Component\Workflow\Marking;
use Symfony\Component\Workflow\MarkingStore\MarkingStoreInterface;

final class DomainMarkingStore implements MarkingStoreInterface
{
    public function __construct(
        private bool $singleState = false,
        private string $property = 'marking'
    ) {
    }

    public function getMarking(object $subject): Marking
    {
        $method = 'get'.ucfirst($this->property);
        if (!method_exists($subject, $method)) {
            throw new LogicException(\Safe\sprintf('The method "%s::%s()" does not exist.', \get_class($subject), $method));
        }

        $marking = $subject->{$method}();
        if (!$marking) {
            return new Marking();
        }

        if ($this->singleState) {
            $marking = [(string) $marking => 1];
        }

        return new Marking($marking);
    }

    public function setMarking(object $subject, Marking $marking, array $context = []): void
    {
        $marking = $marking->getPlaces();

        if ($this->singleState) {
            $marking = key($marking);
        }

        $method = 'set'.ucfirst($this->property);

        if (isset($context['method']) && method_exists($subject, $context['method'])) {
            $method = $context['method'];
        }

        if (!method_exists($subject, $method)) {
            throw new LogicException(\Safe\sprintf('The method "%s::%s()" does not exist.', \get_class($subject), $method));
        }

        $subject->{$method}($marking, $context);
    }
}
