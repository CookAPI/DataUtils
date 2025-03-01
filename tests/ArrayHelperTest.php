<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use CoreApi\DataUtils\ArrayHelper;

final class ArrayHelperTest extends TestCase
{
    public function testGroupByGroupsCorrectly(): void
    {
        $data = [
            ['id' => 1, 'category' => 'A'],
            ['id' => 2, 'category' => 'B'],
            ['id' => 3, 'category' => 'A'],
        ];

        $grouped = ArrayHelper::groupBy($data, 'category');

        $this->assertCount(2, $grouped);
        $this->assertArrayHasKey('A', $grouped);
        $this->assertArrayHasKey('B', $grouped);
        $this->assertCount(2, $grouped['A']);
        $this->assertCount(1, $grouped['B']);
    }
}
