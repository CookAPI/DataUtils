<?php

declare(strict_types=1);

namespace Cook\DataUtils;

/**
 * A helper class for string manipulations.
 */
final class StringFormatter
{
    /**
     * Converts a string to camelCase.
     *
     * @param string $string
     * @return string
     */
    public static function toCamelCase(string $string): string
    {
        return lcfirst(str_replace(' ', '', ucwords(str_replace(['-', '_'], ' ', $string))));
    }

    /**
     * Converts a string to snake_case.
     *
     * @param string $string
     * @return string
     */
    public static function toSnakeCase(string $string): string
    {
        $string = preg_replace('/[A-Z]/', '_$0', $string);
        $string = preg_replace('/\s+/', '_', (string) $string);

        return strtolower(trim((string) $string, '_'));
    }
}
