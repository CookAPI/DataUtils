<?php

declare(strict_types=1);

namespace CoreApi\DataUtils;

use ArrayAccess;
use Countable;
use IteratorAggregate;
use Traversable;
use Closure;
use Generator;
use ArrayIterator;
use RuntimeException;

/**
 * A generic collection class with lazy loading and functional operations.
 *
 * @template T
 * @implements IteratorAggregate<int, T>
 * @implements ArrayAccess<int, T>
 */
class Collection implements IteratorAggregate, ArrayAccess, Countable
{
    /** @var list<T> */
    private array $items;

    private bool $isLazy;

    /**
     * @param iterable<int, T> $items The collection items.
     * @param bool $lazy If true, enables lazy loading.
     */
    public function __construct(iterable $items = [], bool $lazy = false)
    {
        $this->isLazy = $lazy;

        /** @var array<int, T> $arrayItems */
        $arrayItems = iterator_to_array($lazy ? $this->lazyLoad($items) : $items, false);

        /** @var list<T> $itemsList */
        $itemsList = array_values($arrayItems);

        $this->items = $itemsList;
    }

    /**
     * Lazily loads items using a generator.
     *
     * @param iterable<int, T> $items
     * @return Generator<int, T>
     */
    private function lazyLoad(iterable $items): Generator
    {
        foreach ($items as $item) {
            yield $item;
        }
    }

    /**
     * Applies a callback function to each item.
     *
     * @template U
     * @param Closure(T): U $callback The transformation function.
     * @return Collection<U> A new collection with transformed items.
     */
    public function map(Closure $callback): self
    {
        /** @var list<U> $mapped */
        $mapped = array_values(array_map($callback, $this->items));

        return new self($mapped, false);
    }

    /**
     * Filters the collection based on a callback.
     *
     * @param Closure(T): bool $callback The filter function.
     * @return self<T> A new filtered collection.
     */
    public function filter(Closure $callback): self
    {
        /** @var list<T> $filtered */
        $filtered = array_values(array_filter($this->items, $callback));

        return new self($filtered, false);
    }

    /**
     * Reduces the collection to a single value.
     *
     * @template U
     * @param Closure(U, T): U $callback The reducer function.
     * @param U $initial The initial value.
     * @return U The reduced value.
     */
    public function reduce(Closure $callback, mixed $initial): mixed
    {
        return array_reduce($this->items, $callback, $initial);
    }

    /**
     * Returns an iterator for the collection.
     *
     * @return Traversable<int, T>
     */
    public function getIterator(): Traversable
    {
        return new ArrayIterator($this->items);
    }

    /**
     * Counts the number of items in the collection.
     *
     * @return int
     */
    public function count(): int
    {
        return count($this->items);
    }

    /**
     * Checks if an offset exists.
     *
     * @param int $offset
     * @return bool
     */
    public function offsetExists(mixed $offset): bool
    {
        return isset($this->items[$offset]);
    }

    /**
     * Retrieves the value at the given offset.
     *
     * @param int $offset
     * @return T|null
     */
    public function offsetGet(mixed $offset): mixed
    {
        return $this->items[$offset] ?? null;
    }

    /**
     * Sets the value at the given offset.
     *
     * @param int|null $offset
     * @param T $value
     */
    public function offsetSet(mixed $offset, mixed $value): void
    {
        if ($this->isLazy) {
            throw new RuntimeException("Cannot modify a lazy collection.");
        }

        if ($offset === null) {
            $this->items[] = $value;
        } else {
            $this->items[$offset] = $value;
        }
    }

    /**
     * Unsets an offset.
     *
     * @param int $offset
     */
    public function offsetUnset(mixed $offset): void
    {
        if ($this->isLazy) {
            throw new RuntimeException("Cannot modify a lazy collection.");
        }

        unset($this->items[$offset]);
    }
}
