<?php
declare(strict_types=1);

namespace ArrayList;

use Sevavietl\OverloadedFunction\OverloadedFunction;
use TypeGuard\Guard;

class ArrayList implements Collection
{
    private $values = [];
    private $type;
    private $typeGuard;

    private $position = 0;

    private $size = 0;


    public function __construct(...$args)
    {

        $a = new OverloadedFunction([
            'string' => function ($type) {
                $this->typeGuard = new Guard($type);
                $this->type = $type;
            },
            'string, array' => function ($type, $values) {
                $this->typeGuard = new Guard($type);
                $this->type = $type;
                foreach ($values as $value) {
                    if (!$this->typeGuard->match($value)) {
                        throw new ClassCastException();
                    }
                }
                $this->values = $values;
            },
            'string, ArrayList\Collection' => function ($type, $values) {
                $this->typeGuard = new Guard($type);
                $this->type = $type;
                foreach ($values as $value) {
                    if (!$this->typeGuard->match($value)) {
                        throw new ClassCastException();
                    }
                    $this->values[] = $value;
                }
            }
        ]);

        \call_user_func_array($a, $args);

    }

    public function isEmpty(): bool
    {
        return \count($this->values) <= 0;
    }

    public function add(...$args): bool
    {
        $add = new OverloadedFunction([

            $this->type => function ($element) {
                $this->values[] = $element;
                $this->size++;
                return true;
            },
            "integer, {$this->type}" => function ($index, $element) {
                if (\array_key_exists($index, $this->values)) {
                    $this->values = \array_merge(\array_slice($this->values, 0, $index), [$element], \array_slice($this->values, $index));
                    $this->size++;
                } else {
                    $this->add($element);
                }
                return true;
            },
        ]);
        return $add(...$args);
    }

    public function get(int $index)
    {
        if (!array_key_exists($index, $this->values)) {
            throw new \OutOfBoundsException('Out of range');
        }
        return $this->values[$index];
    }

    public function set(int $index, $element): void
    {
        if (!array_key_exists($index, $this->values)) {
            throw new \OutOfBoundsException('Out of range');
        }
        if (!$this->typeGuard->match($element)) {
            throw new \InvalidArgumentException("Elements was be instance of {$this->type}");
        }

        $this->values[$index] = $element;
    }

    public function size(): int
    {
        return $this->size;
    }

    public function contains($element): bool
    {
        return $this->indexOf($element) >= 0;
    }

    public function indexOf($element): int
    {
        if (!\in_array($element, $this->values)) {
            return -1;
        }
        return (int)\array_search($element, $this->values, true);
    }

    public function lastIndexOf($element): int
    {
        if (!\in_array($element, $this->values)) {
            return -1;
        }

        for ($index = \count($this->values) - 1; $index >= 0; $index--) {
            if ($this->values[$index] == $element) {
                return $index;
            }
        }
    }

    public function toArray(): array
    {
        return $this->values;
    }

    public function clear(): void
    {
        unset($this->values);
        $this->values = [];
    }

    public function addAll(...$args): bool
    {

        $typeCollection = Collection::class;
        $addAll = new OverloadedFunction(
            [
                $typeCollection => function (Collection $collection) {
                    if ($collection->isEmpty()) {
                        return true;
                    }
                    $this->guardCollectionType($collection);
                    foreach ($collection as $value) {
                        $this->values[] = $value;
                        $this->size++;

                    }
                    return true;
                },
                "integer, {$typeCollection}" => function ($index, Collection $collection) {

                    if (!array_key_exists($index, $this->values)) {
                        throw new \OutOfBoundsException('Out of range');
                    }
                    if ($collection->isEmpty()) {
                        return true;
                    }
                    $this->guardCollectionType($collection);
                    $tmp = \array_slice($this->values, 0, $index);
                    $tmp = array_merge($tmp, $collection->toArray());
                    $tmp = array_merge($tmp, \array_slice($this->values, $index));
                    $this->values = $tmp;
                    $this->size += $collection->size();
                    unset($tmp);
                    return true;
                }
            ]
        );
        return \call_user_func_array($addAll, $args);

    }

    public function containsAll(Collection $collection): bool
    {
        if ($collection->size() <= 0) {
            throw new \InvalidArgumentException('Collections must be not empty');
        }
        foreach ($collection as $value) {
            if (!$this->typeGuard->match($value)) {
                throw new ClassCastException('Type elements of second collection not supported');
            }
            if (!$this->contains($value)) {
                return false;
            }
        }
        return true;
    }

    public function remove(...$args)
    {
        $remove = new OverloadedFunction(
            [
                'integer, ?boolean' => function ($index, $byIndex = true) {
                    $tmp = $this->get($index);
                    if ($byIndex) {
                        array_splice($this->values, $index, 1);
                    }
                    $this->size--;
                    return $tmp;
                },
                $this->type => function ($element) {
                    return $this->remove($this->indexOf($element), true) ? true : false;
                }

            ]
        );
        return \call_user_func_array($remove, $args);
    }

    private function guardCollectionType(Collection $collection)
    {
        foreach ($collection as $value) {
            if (!$this->typeGuard->match($value)) {
                throw new ClassCastException();
            }

        }
    }

    public function removeAll(Collection $collection): bool
    {
        $this->guardCollectionType($collection);
        foreach ($collection as $value) {
            $this->remove($value);
        }
        return true;
    }

    public function current()
    {
        return $this->values[$this->position];
    }

    public function next(): void
    {
        ++$this->position;
    }

    public function key(): int
    {
        return $this->position;
    }

    public function valid(): bool
    {
        return isset($this->values[$this->position]);
    }

    public function rewind(): void
    {
        $this->position = 0;
    }

    public function removeRange(int $from, int $to): void
    {
        if ($from == $to) {
            return;
        }

        if ($from === $to || $from < 0 || $from > $to || $to > $this->size()) {
            throw new \OutOfBoundsException();
        }

        foreach (range($to, $from) as $value) {
            $this->remove($value, true);
        }
    }
}
