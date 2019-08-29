<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

final class WithLocalCacheKeyTest extends TestCase
{
  public function testHasLocalCacheKey(): void
  {
    $dummy = new WithLocalCacheKeyTestDummy();
    $this->assertEquals('This is a non static cache key', $dummy->getLocalCacheKey());
    $this->assertEquals('This is a static cache key', WithLocalCacheKeyTestDummy::getStaticLocalCacheKey());
  }
}



class WithLocalCacheKeyTestDummy
{
  use \Khwadj\Eloquent\WithLocalCacheKey;

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
}


