# Cook Data Utils

Cook Data Utils is a PHP library providing utility functions for handling collections, arrays, strings, numbers, and dates.  
The module is designed with performance, modularity, and lazy evaluation in mind.

## Features

- Collection Handling (map, filter, reduce, lazy evaluation)
- Array Manipulations (grouping, transformation)
- String Formatting (camelCase, snake_case conversion)
- Number Formatting (rounding, precision formatting)
- Date Utilities (formatting, differences)

## Installation

Install the package using Composer:

```shell
composer require cook/data-utils
```

## Usage examples

### Collection

```php
use Cook\DataUtils\Collection;

$collection = new Collection([1, 2, 3, 4, 5]);

// Map: Multiply each number by 2
$doubled = $collection->map(fn(int $n) => $n * 2);
print_r(iterator_to_array($doubled)); // [2, 4, 6, 8, 10]

// Filter: Keep only even numbers
$filtered = $collection->filter(fn(int $n) => $n % 2 === 0);
print_r(iterator_to_array($filtered)); // [2, 4]

// Reduce: Sum all numbers
$sum = $collection->reduce(fn(int $acc, int $n) => $acc + $n, 0);
echo "Sum: $sum\n"; // Sum: 15
```

### Array Utilities

```php
use Cook\DataUtils\ArrayHelper;

$data = [
    ['id' => 1, 'category' => 'A'],
    ['id' => 2, 'category' => 'B'],
    ['id' => 3, 'category' => 'A'],
];

// Group by category
$grouped = ArrayHelper::groupBy($data, 'category');
print_r($grouped);
```

### String Formatting

```php
use Cook\DataUtils\StringFormatter;

echo StringFormatter::toCamelCase('hello_world'); // helloWorld
echo StringFormatter::toSnakeCase('HelloWorld');  // hello_world
```

### Number Formatting

```php
use Cook\DataUtils\NumberFormatter;

echo NumberFormatter::format(123.456, 2); // 123.46
echo NumberFormatter::roundUp(123.456, 0); // 124
echo NumberFormatter::roundDown(123.999, 0); // 123
```

### Date Utilities

```php
use Cook\DataUtils\DateHelper;

echo DateHelper::now(); // 2024-03-01 12:34:56
echo DateHelper::format('2024-03-01 12:34:56', 'Y-m-d'); // 2024-03-01
echo DateHelper::diffInDays('2024-03-01', '2024-03-06'); // 5
```

## Development & Testing

Run tests using PHPUnit:

```shell
vendor/bin/phpunit
```

Check code style using PHP CodeSniffer:

```shell
vendor/bin/phpcs --standard=PSR12 src/
```

Run static analysis using PHPStan:

```shell
vendor/bin/phpstan analyse --level=8 src/
```

## License

This package is licensed under the MIT License.

## Contributing

Contributions are welcome. Fork the repository, open issues, or submit pull requests.

## Links

    GitHub: https://github.com/CookApi/DataUtils
    Packagist: https://packagist.org/packages/cook/data-utils
