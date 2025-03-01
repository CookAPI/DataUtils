<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Cook\DataUtils\NumberFormatter;

final class NumberFormatterTest extends TestCase
{
    public function testFormat(): void
    {
        $this->assertSame('123.46', NumberFormatter::format(123.456, 2));
    }

    public function testRoundUp(): void
    {
        $this->assertSame(124.0, NumberFormatter::roundUp(123.456, 0));
    }

    public function testRoundDown(): void
    {
        $this->assertSame(123.0, NumberFormatter::roundDown(123.999, 0));
    }
}
