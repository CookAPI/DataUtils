<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Cook\DataUtils\DateHelper;

final class DateHelperTest extends TestCase
{
    /**
     * @throws DateMalformedStringException
     * @throws DateInvalidTimeZoneException
     */
    public function testNowReturnsValidDate(): void
    {
        $now = DateHelper::now();
        $this->assertMatchesRegularExpression('/\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}/', $now);
    }

    /**
     * @throws DateMalformedStringException
     */
    public function testFormatConvertsDateCorrectly(): void
    {
        $this->assertSame('2024-03-01', DateHelper::format('2024-03-01 12:34:56', 'Y-m-d'));
    }

    /**
     * @throws DateMalformedStringException
     */
    public function testDiffInDays(): void
    {
        $this->assertSame(5, DateHelper::diffInDays('2024-03-01', '2024-03-06'));
    }
}
