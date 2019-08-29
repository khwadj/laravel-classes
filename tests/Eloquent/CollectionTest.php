<?php

declare(strict_types=1);

use Khwadj\Eloquent\Collection;
use PHPUnit\Framework\TestCase;

final class CollectionTest extends TestCase
{
  public function testAdd(): void
  {
    $key   = 'key';
    $value = 'value';

    $collection = new Collection();
    $collection->add($value, $key);
    $this->assertTrue($collection->has($key));
    $this->assertEquals($value, $collection->get($key));
  }

  public function testConstruct(): void
  {
    $key1 = 'A';
    $key2 = 3;
    $value1 = 'Banana';
    $value2 = (object)['b' => 'Apple'];

    $indexed = [
      $key1 => $value1,
      $key2 => $value2,
    ];

    $collection = new Collection($indexed);
    $this->assertTrue($collection->has($key1));
    $this->assertTrue($collection->has($key2));
    $this->assertEquals($value1, $collection->get($key1));
    $this->assertEquals($value2, $collection->get($key2));
  }
}

