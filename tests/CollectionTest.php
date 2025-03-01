<?php

declare(strict_types=1);

use CoreApi\DataUtils\Collection;
use PHPUnit\Framework\TestCase;

final class CollectionTest extends TestCase
{
    public function testCanCreateCollection(): void
    {
        $collection = new Collection([1, 2, 3]);
        $this->assertCount(3, $collection);
    }

    public function testMapAppliesFunctionToAllElements(): void
    {
        $collection = new Collection([1, 2, 3]);
        $doubled = $collection->map(fn(int $n) => $n * 2);

        $this->assertSame([2, 4, 6], iterator_to_array($doubled));
    }

    public function testFilterRemovesElementsThatDoNotMatchCondition(): void
    {
        $collection = new Collection([1, 2, 3, 4]);
        $filtered = $collection->filter(fn(int $n) => $n % 2 === 0);

        $this->assertSame([2, 4], iterator_to_array($filtered));
    }

    public function testReduceAggregatesValues(): void
    {
        $collection = new Collection([1, 2, 3, 4]);
        $sum = $collection->reduce(fn(int $acc, int $n) => $acc + $n, 0);

        $this->assertSame(10, $sum);
    }

    public function testOffsetGetReturnsCorrectValue(): void
    {
        $collection = new Collection([10, 20, 30]);
        $this->assertSame(20, $collection[1]);
    }

    public function testOffsetSetModifiesCollection(): void
    {
        $collection = new Collection([10, 20, 30]);
        $collection[1] = 50;
        $this->assertSame(50, $collection[1]);
    }

    public function testOffsetUnsetRemovesElement(): void
    {
        $collection = new Collection([10, 20, 30]);
        unset($collection[1]);

        $this->assertFalse(isset($collection[1]));
    }
}
