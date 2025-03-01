<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use CoreApi\DataUtils\StringFormatter;

final class StringFormatterTest extends TestCase
{
    public function testToCamelCase(): void
    {
        $this->assertSame('helloWorld', StringFormatter::toCamelCase('hello_world'));
        $this->assertSame('helloWorld', StringFormatter::toCamelCase('hello-world'));
    }

    public function testToSnakeCase(): void
    {
        $this->assertSame('hello_world', StringFormatter::toSnakeCase('HelloWorld'));
        $this->assertSame('hello_world', StringFormatter::toSnakeCase('hello world'));
    }
}
