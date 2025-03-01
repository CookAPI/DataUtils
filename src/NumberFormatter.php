<?php

declare(strict_types=1);

namespace Cook\DataUtils;

/**
 * A helper class for number formatting.
 */
final class NumberFormatter
{
    /**
     * Formats a float to a string with a fixed number of decimals.
     *
     * @param float $number
     * @param int $decimals
     * @return string
     */
    public static function format(float $number, int $decimals = 2): string
    {
        return number_format($number, $decimals, '.', ' ');
    }

    /**
     * Rounds a number up to the nearest precision.
     *
     * @param float $number
     * @param int $precision
     * @return float
     */
    public static function roundUp(float $number, int $precision = 0): float
    {
        return ceil($number * (10 ** $precision)) / (10 ** $precision);
    }

    /**
     * Rounds a number down to the nearest precision.
     *
     * @param float $number
     * @param int $precision
     * @return float
     */
    public static function roundDown(float $number, int $precision = 0): float
    {
        return floor($number * (10 ** $precision)) / (10 ** $precision);
    }
}
