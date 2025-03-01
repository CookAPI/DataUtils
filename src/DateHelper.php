<?php

declare(strict_types=1);

namespace CoreApi\DataUtils;

use DateTimeImmutable;
use DateTimeZone;

/**
 * A helper class for date manipulations.
 */
final class DateHelper
{
    /**
     * Gets the current timestamp formatted as a string.
     *
     * @param string $timezone
     * @return string
     * @throws \DateMalformedStringException
     * @throws \DateInvalidTimeZoneException
     */
    public static function now(string $timezone = 'UTC'): string
    {
        return (new DateTimeImmutable('now', new DateTimeZone($timezone)))->format('Y-m-d H:i:s');
    }

    /**
     * Formats a date string into a specific format.
     *
     * @param string $date
     * @param string $format
     * @return string
     * @throws \DateMalformedStringException
     */
    public static function format(string $date, string $format = 'Y-m-d'): string
    {
        return (new DateTimeImmutable($date))->format($format);
    }

    /**
     * Calculates the difference in days between two dates.
     *
     * @param string $start
     * @param string $end
     * @return int
     * @throws \DateMalformedStringException
     */
    public static function diffInDays(string $start, string $end): int
    {
        $startDate = new DateTimeImmutable($start);
        $endDate = new DateTimeImmutable($end);

        return (int) $startDate->diff($endDate)->days;
    }
}
