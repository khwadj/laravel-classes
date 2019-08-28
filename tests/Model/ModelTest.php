<?php
declare(strict_types=1);

use Khwadj\Model\Model;
use PHPUnit\Framework\TestCase;

final class ModelTest extends TestCase
{
  public function testCacheKey(): void
  {
    $primary_key = 999;

    $dummy = new ModelTestDummy([
      'primary_key' => $primary_key
    ]);

    $this->assertEquals($primary_key, $dummy->getLocalCacheKey());
  }

  public function testStaticCacheKey(): void
  {
    $this->assertEquals(ModelTestDummy::class, ModelTestDummy::getStaticLocalCacheKey());
  }

  public function testTest(): void
  {
    //ModelTestDummy::find(1);
  }

  /*
  public function _testCacheCall(): void
  {
    $primary_key = 999;

    $dummy = new ModelTestDummy([
      'primary_key' => $primary_key
    ]);

    $this->assertEmpty(ModelTestDummy::getLocalCacheContent());

    $returned = $dummy->dummyFunction();

    $this->assertEmpty(ModelTestDummy::getLocalCacheContent());


    $returned2 = $dummy->dummyFunction_with_khwadj_local_cache();

    $this->assertEquals($returned, $returned2);
    $this->assertNotEmpty(ModelTestDummy::getLocalCacheContent());

    $returned3 = $dummy->dummyFunction_with_khwadj_local_cache();

    $this->assertEquals($returned, $returned3);
    $this->assertNotEmpty(ModelTestDummy::getLocalCacheContent());

  }
  */

}

/**
 * Class ModelTestDummy
 *
 * @property int    $primary_key
 */
class ModelTestDummy extends Model
{
  protected $primaryKey = 'primary_key';
  protected $fillable   = [
    'primary_key'
  ];

  // needed function to implement the trait

  /**
   * @return string
   */
  public function getLocalCacheKey()
  {
    return $this->primary_key;
  }

  /**
   * @return string
   */
  static public function getStaticLocalCacheKey()
  {
    return static::class;
  }

  function dummyFunction()
  {
    return 'banana';
  }
}


