<?php

namespace ArrayList;

interface Collection extends \Iterator
{
    public function add(...$args): bool;

    public function addAll(...$args): bool;

    public function clear(): void;

    public function contains($object): bool;

    public function containsAll(Collection $collection): bool;

    public function isEmpty(): bool;

    public function remove(...$args);

    public function removeAll(Collection $collection): bool;

    public function toArray(): array;

    public function size(): int;

}
