<?php

declare(strict_types=1);

namespace App\UI\Admin\Form\Transformer;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

final class SpacesToArrayTransformer implements DataTransformerInterface
{
    /**
     * Transforms a collection into an array.
     *
     * @param mixed $collection
     *
     * @throws TransformationFailedException
     *
     * @return mixed An array of entities
     */
    public function transform($collection)
    {
        if (null === $collection) {
            return [];
        }

        // For cases when the collection getter returns $collection->toArray()
        // in order to prevent modifications of the returned collection
        if (\is_array($collection)) {
            return $collection;
        }

        if (!$collection instanceof Collection) {
            throw new TransformationFailedException('Expected a Doctrine\Common\Collections\Collection object.');
        }

        $results = [];
        foreach ($collection->toArray() as $choices) {
            $results[$choices['name']] = $choices['id'];
        }

        return $results;
    }

    /**
     * Transforms choice keys into entities.
     *
     * @param mixed $array An array of entities
     *
     * @return Collection A collection of entities
     */
    public function reverseTransform($array)
    {
        if ('' === $array || null === $array) {
            $array = [];
        } else {
            $array = (array) $array;
        }

        return new ArrayCollection($array);
    }
}
