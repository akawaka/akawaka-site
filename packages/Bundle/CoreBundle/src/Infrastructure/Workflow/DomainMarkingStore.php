<?php

declare(strict_types=1);

namespace Black\Bundle\CoreBundle\Infrastructure\Workflow;

use Symfony\Component\Workflow\Exception\LogicException;
use Symfony\Component\Workflow\Marking;
use Symfony\Component\Workflow\MarkingStore\MarkingStoreInterface;

final class DomainMarkingStore implements MarkingStoreInterface
{
    private bool $singleState;
    private string $property;

    public function __construct(bool $singleState = false, string $property = 'marking')
    {
        $this->singleState = $singleState;
        $this->property = $property;
    }

    public function getMarking(object $subject): Marking
    {
        $method = 'get'.ucfirst($this->property);
        if (!method_exists($subject, $method)) {
            throw new LogicException(sprintf('The method "%s::%s()" does not exist.', \get_class($subject), $method));
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

        if (true === isset($context['method'])) {
            if (true === method_exists($subject, $context['method'])) {
                $method = $context['method'];
            }
        }

        if (false === method_exists($subject, $method)) {
            throw new LogicException(sprintf('The method "%s::%s()" does not exist.', \get_class($subject), $method));
        }

        $subject->{$method}($marking, $context);
    }
}
