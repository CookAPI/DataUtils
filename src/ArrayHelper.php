<?php

declare(strict_types=1);

namespace Cook\DataUtils;

/**
 * A helper class for array manipulations.
 */
final class ArrayHelper
{
    /**
     * Groups an array by a specific key.
     *
     * @template TValue
     *
     * @param array<int, array<string, TValue>> $array The input array.
     * @param string $key The key to group by.
     *
     * @return array<array-key, list<array<string, TValue>>> The grouped array.
     */
    public static function groupBy(array $array, string $key): array
    {
        /** @var array<array-key, list<array<string, TValue>>> $result */
        $result = [];

        foreach ($array as $item) {
            if (!isset($item[$key])) {
                continue;
            }

            /** @var array-key $groupKey */
            $groupKey = $item[$key];

            if (!isset($result[$groupKey])) {
                $result[$groupKey] = [];
            }

            $result[$groupKey][] = $item;
        }

        return $result;
    }
}
