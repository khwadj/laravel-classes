<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

final class WithLocalCacheTest extends TestCase
{
  public function testHasAttributes(): void
  {
    $this->assertClassHasAttribute('_local_cache', $this->getMockClass('WithLocalCacheTestDummy'));
    $this->assertClassHasStaticAttribute('_local_cache_suffix', $this->getMockClass('WithLocalCacheTestDummy'));
  }

  public function testHasLocalCacheKey(): void
  {
    $dummy = new WithLocalCacheTestDummy();
    $this->assertEquals('This is a non static cache key', $dummy->getLocalCacheKey());
    $this->assertEquals('This is a static cache key', WithLocalCacheTestDummy::getStaticLocalCacheKey());
  }

  public function testLocalCacheSuffixe(): void
  {
    $this->assertEquals('_with_khwadj_local_cache', WithLocalCacheTestDummy::getLocalCacheSuffix());
  }

  public function testCacheSetGetHas()
  {
    $this->assertEmpty(WithLocalCacheTestDummy::getLocalCacheContent());

    $key   = 'key';
    $value = 'value';

    WithLocalCacheTestDummy::cacheSet($key, $value);
    $this->assertNotEmpty(WithLocalCacheTestDummy::getLocalCacheContent());
    $this->assertTrue(WithLocalCacheTestDummy::hasKey($key));
    $this->assertEquals($value, WithLocalCacheTestDummy::cacheGet($key));
  }
}


class WithLocalCacheTestDummy
{
  use \Khwadj\Model\WithLocalCache;

  // needed function to implement the trait

  /**
   * @return string
   */
  public function getLocalCacheKey()
  {
    return 'This is a non static cache key';
  }

  /**
   * @return string
   */
  static public function getStaticLocalCacheKey()
  {
    return 'This is a static cache key';
  }

  public function dummyFunction()
  {
    return 'dummy return';
  }
}

